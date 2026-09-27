<?php

namespace App\Services\Docs;

use League\CommonMark\Environment\Environment;
use League\CommonMark\Extension\CommonMark\CommonMarkCoreExtension;
use League\CommonMark\Extension\CommonMark\Node\Block\Heading;
use League\CommonMark\Extension\CommonMark\Node\Inline\Image;
use League\CommonMark\Extension\CommonMark\Node\Inline\Link;
use League\CommonMark\Extension\GithubFlavoredMarkdownExtension;
use League\CommonMark\Node\Node;
use League\CommonMark\Parser\MarkdownParser;
use League\CommonMark\Renderer\HtmlRenderer;
use RuntimeException;
use Symfony\Component\Yaml\Yaml;

class ContentParser
{
    public function parse(string $root): array
    {
        $root = realpath($root) ?: throw new RuntimeException('Docs directory does not exist.');
        $manifest = json_decode($this->read($root, 'docs.json'), true, flags: JSON_THROW_ON_ERROR);
        $schema = $manifest['schema'] ?? null;
        $catalog = $this->catalog($manifest);
        $versioned = $schema === 2;
        $files = new \RecursiveIteratorIterator(new \RecursiveDirectoryIterator($root.'/docs', \FilesystemIterator::SKIP_DOTS));
        $documents = $assets = $links = [];
        foreach ($files as $file) {
            if ($file->isLink()) {
                throw new RuntimeException('Symlinks are not permitted in docs.');
            }
            if ($file->getExtension() !== 'md') {
                continue;
            }
            $path = substr($file->getPathname(), strlen($root) + 1);
            $slug = substr($path, 5, -3);
            $version = null;
            if ($versioned) {
                if (! preg_match('~^v([1-9][0-9]*)/(.+)$~', $slug, $match) || ! isset($catalog['versions'][$match[1]])) {
                    throw new RuntimeException("Document is outside a declared version: {$path}");
                }
                $version = $match[1];
                $slug = $match[2];
            }
            $documentKey = $this->key($slug, $version);
            if (! preg_match('~^[a-z0-9][a-z0-9/-]*$~D', $slug) || str_contains($slug, '//') || in_array(explode('/', $slug)[0], ['search', 'ask', 'assets'], true)) {
                throw new RuntimeException("Invalid document path: {$path}");
            }
            [$meta, $body] = $this->frontMatter($this->read($root, $path));
            $versions = $meta['versions'] ?? [];
            if (! is_array($versions) || array_diff($versions, ['2', '3']) || ($meta['lang'] ?? 'en') !== 'en') {
                throw new RuntimeException("Invalid versions or language: {$path}");
            }
            $versions = array_values(array_map('strval', $versions));
            sort($versions);
            if ($versioned && ($versions !== [$version] || ($meta['reviewed_against'] ?? '') !== $catalog['versions'][$version]['source_commit'])) {
                throw new RuntimeException("Document version/review baseline mismatch: {$path}");
            }
            $hash = $this->reviewHash($body, $versions, (string) ($meta['title'] ?? ''));
            $environment = new Environment(['html_input' => 'escape', 'allow_unsafe_links' => false, 'max_nesting_level' => 50]);
            $environment->addExtension(new CommonMarkCoreExtension);
            $environment->addExtension(new GithubFlavoredMarkdownExtension);
            $ast = (new MarkdownParser($environment))->parse($body);
            $headings = $seen = [];
            $walker = $ast->walker();
            while ($event = $walker->next()) {
                if (! $event->isEntering()) {
                    continue;
                }
                $node = $event->getNode();
                if ($node instanceof Heading) {
                    $label = $this->nodeText($node);
                    $base = $this->anchor($label);
                    $number = $seen[$base] ?? 0;
                    $seen[$base] = $number + 1;
                    $id = $base.($number ? '-'.$number : '');
                    $node->data->set('attributes/id', $id);
                    $headings[] = ['id' => $id, 'text' => $label, 'level' => $node->getLevel()];
                }
                if ($node instanceof Image || $node instanceof Link) {
                    $url = $node->getUrl();
                    if (preg_match('~^https://docs\.invoiceshelf\.com(/.*)?$~', $url, $match)) {
                        $url = $match[1] ?? '/';
                        if ($versioned && ! str_starts_with($url, '/images/')) {
                            $legacy = preg_replace('~\.(?:html|md)(?=#|$)~', '', ltrim($url, '/'));
                            [$legacySlug, $legacyAnchor] = array_pad(explode('#', $legacy, 2), 2, '');
                            $url = '/docs/'.($catalog['redirects'][$legacySlug ?: 'index'] ?? 'v'.$catalog['default'].'/'.($legacySlug ?: 'index')).($legacyAnchor ? '#'.$legacyAnchor : '');
                        }
                    }
                    if (preg_match('~^(?:https?://|mailto:)~i', $url)) {
                        if ($node instanceof Image) {
                            throw new RuntimeException("Store documentation images in the repository: {$path}");
                        }

                        continue;
                    }
                    if (preg_match('~^[a-z][a-z0-9+.-]*:|^//~i', $url)) {
                        throw new RuntimeException("Unsafe link in {$path}");
                    }
                    [$target, $fragment] = array_pad(explode('#', $url, 2), 2, '');
                    $target = explode('?', $target, 2)[0];
                    $targetVersion = $version;
                    if ($versioned && preg_match('~^/docs/v([1-9][0-9]*)(?:/(.*))?$~', $target, $match)) {
                        $targetVersion = $match[1];
                        $resolved = ($match[2] ?? '') ?: 'index';
                    } else {
                        $resolved = $target === '' ? $slug.'.md' : $this->resolve($slug, rawurldecode($target));
                    }
                    if ($node instanceof Image) {
                        if ($versioned && ! str_starts_with($resolved, 'images/v'.$version.'/')) {
                            throw new RuntimeException("Screenshot belongs outside v{$version}: {$resolved}");
                        }
                        $source = str_starts_with($resolved, 'images/') ? 'docs/public/'.$resolved : 'docs/'.$resolved;
                        $assets[$resolved] ??= $this->asset($root, $source, $resolved);
                        if ($versioned) {
                            $capture = json_decode($this->read($root, $source.'.capture.json'), true, flags: JSON_THROW_ON_ERROR);
                            $book = $catalog['versions'][$version];
                            if (($capture['app'] ?? '') !== 'v'.$version || ($capture['source_revision'] ?? '') !== $book['source_commit'] || ($capture['source_version'] ?? '') !== $book['release'] || ($capture['source_dirty'] ?? true)) {
                                throw new RuntimeException("Screenshot version or release does not match {$path}: {$source}");
                            }
                        }
                        $node->setUrl('/docs/assets/'.$assets[$resolved]['hash']);
                    } else {
                        $targetSlug = preg_replace('~\.(?:md|html)$~', '', rtrim($resolved, '/')) ?: 'index';
                        $links[] = [$documentKey, $this->key($targetSlug, $targetVersion), rawurldecode($fragment)];
                        $node->setUrl($this->url($targetSlug, $targetVersion).($fragment !== '' ? '#'.$fragment : ''));
                    }
                }
            }
            $title = $meta['title'] ?? ($headings[0]['text'] ?? null);
            if (! is_string($title) || trim($title) === '' || mb_strlen($title) > 255) {
                throw new RuntimeException("Missing or invalid title: {$path}");
            }
            $renderer = new HtmlRenderer($environment);
            $html = (string) $renderer->renderDocument($ast);
            foreach (($meta['anchor_aliases'] ?? []) as $alias => $targetId) {
                if (! preg_match('/^[a-z0-9_-]+$/D', $alias) || ! in_array($targetId, array_column($headings, 'id'), true) || in_array($alias, array_column($headings, 'id'), true)) {
                    throw new RuntimeException("Invalid heading alias: {$path}");
                }
                $html = preg_replace('~(<h[1-6] id="'.preg_quote($targetId, '~').'")~', '<span id="'.$alias.'" class="docs-anchor" aria-hidden="true"></span>$1', $html, 1);
                $headings[] = ['id' => $alias, 'text' => '', 'level' => 0];
            }
            $plain = $this->plain($html);
            $chunks = [];
            $heading = $title;
            $anchor = $headings[0]['id'] ?? '';
            foreach ($ast->children() as $node) {
                if ($node instanceof Heading) {
                    $heading = $this->nodeText($node);
                    $anchor = $node->data->get('attributes/id');

                    continue;
                }
                $text = $this->plain((string) $renderer->renderNodes([$node]));
                if ($text === '') {
                    continue;
                }
                // Bounded chunks preserve paragraphs/code blocks unless an individual block is oversized.
                foreach (mb_str_split($text, 2400) as $part) {
                    $last = array_key_last($chunks);
                    if ($last !== null && $chunks[$last]['anchor'] === $anchor && mb_strlen($chunks[$last]['text']) + mb_strlen($part) < 2400) {
                        $chunks[$last]['text'] .= "\n\n".$part;
                    } else {
                        $chunks[] = ['anchor' => $anchor, 'heading' => $heading, 'text' => $part];
                    }
                }
            }
            $reviewed = $versions !== [] && hash_equals($hash, (string) ($meta['reviewed_hash'] ?? $meta['rag_reviewed_hash'] ?? ''));
            if ($versioned && ! $reviewed) {
                throw new RuntimeException("Review the current text before publishing: {$path}");
            }
            $documents[$documentKey] = [
                'version' => $version, 'slug' => $slug, 'source_path' => $path, 'title' => $title,
                'description' => (string) ($meta['description'] ?? mb_substr(preg_replace('/\s+/u', ' ', $plain), 0, 180)),
                'language' => 'en', 'versions' => $versions,
                'reviewed' => $reviewed,
                'content_hash' => $hash, 'markdown' => $body, 'html' => $html, 'plain_text' => $plain,
                'headings' => $headings, 'chunks' => $chunks,
            ];
        }
        // Keep legacy screenshot URLs working even when a guide now uses a newer image.
        if (is_dir($root.'/docs/public/images')) {
            $images = new \RecursiveIteratorIterator(new \RecursiveDirectoryIterator($root.'/docs/public/images', \FilesystemIterator::SKIP_DOTS));
            foreach ($images as $image) {
                if (! preg_match('/\.(png|jpe?g|webp|gif)$/i', $image->getFilename())) {
                    continue;
                }
                $source = substr($image->getPathname(), strlen($root) + 1);
                $resolved = substr($source, strlen('docs/public/'));
                $assets[$resolved] ??= $this->asset($root, $source, $resolved);
            }
        }
        $indexes = $versioned ? array_map(fn ($v) => $this->key('index', (string) $v), array_keys($catalog['versions'])) : ['index'];
        if (array_diff($indexes, array_keys($documents)) || count($documents) > 2000) {
            throw new RuntimeException('Docs must contain an index and at most 2000 documents.');
        }
        foreach ($links as [$from, $to, $fragment]) {
            if (! isset($documents[$to]) || ($fragment !== '' && ! in_array($fragment, array_column($documents[$to]['headings'], 'id'), true))) {
                throw new RuntimeException("Broken link: {$from} -> {$to}#{$fragment}");
            }
        }
        $navigations = $versioned ? array_map(fn ($book) => $book['navigation'], $catalog['versions']) : ['' => $manifest['navigation']];
        foreach ($navigations as $version => $groups) {
            foreach ($groups as $group) {
                if (! is_string($group['title'] ?? null) || ! is_array($group['items'] ?? null)) {
                    throw new RuntimeException('Invalid navigation group.');
                }
                foreach ($group['items'] as $item) {
                    if (! is_string($item['title'] ?? null) || ! isset($documents[$this->key($item['slug'] ?? '', $versioned ? (string) $version : null)])) {
                        throw new RuntimeException('Navigation points to a missing page.');
                    }
                }
            }
        }
        if ($versioned) {
            foreach ($catalog['redirects'] as $from => $to) {
                if (! preg_match('~^[a-z0-9][a-z0-9/-]*$~D', $from) || ! preg_match('~^v([1-9][0-9]*)/(.+)$~D', $to, $match) || ! isset($documents[$this->key($match[2], $match[1])])) {
                    throw new RuntimeException('Invalid legacy documentation redirect.');
                }
            }
        }
        ksort($documents);

        return ['schema' => $schema, 'catalog' => $catalog, 'documents' => $documents, 'assets' => $assets, 'navigation' => $manifest['navigation'] ?? []];
    }

    public function frontMatter(string $markdown): array
    {
        $markdown = str_replace("\r\n", "\n", $markdown);
        if (preg_match('/\A---\n(.*?)\n---\n(.*)\z/s', $markdown, $match)) {
            $meta = Yaml::parse($match[1]);
            if (! is_array($meta)) {
                throw new RuntimeException('Front matter must be a mapping.');
            }

            return [$meta, trim($match[2])."\n"];
        }

        if (str_starts_with($markdown, "---\n")) {
            throw new RuntimeException('Unclosed documentation front matter.');
        }

        return [[], trim($markdown)."\n"];
    }

    public function reviewHash(string $body, array $versions, string $title = ''): string
    {
        sort($versions);

        return hash('sha256', json_encode(array_values($versions)).($title !== '' ? "\ntitle:".$title : '')."\n".trim(str_replace("\r\n", "\n", $body))."\n");
    }

    public function url(string $slug, ?string $version = null): string
    {
        return '/docs'.($version ? '/v'.$version : '').($slug === 'index' ? '' : '/'.$slug);
    }

    private function key(string $slug, ?string $version): string
    {
        return ($version ? $version.':' : '').$slug;
    }

    private function catalog(array $manifest): ?array
    {
        if (($manifest['schema'] ?? null) === 1 && is_array($manifest['navigation'] ?? null)) {
            return null;
        }
        if (($manifest['schema'] ?? null) !== 2 || ! is_array($manifest['versions'] ?? null) || ! isset($manifest['versions'][$manifest['default'] ?? ''], $manifest['versions'][$manifest['latest'] ?? ''])) {
            throw new RuntimeException('Unsupported docs manifest or missing default/latest collection.');
        }
        foreach ($manifest['versions'] as $id => $book) {
            if (! preg_match('/^[1-9][0-9]*$/D', (string) $id) || ! is_string($book['label'] ?? null) || ! is_array($book['navigation'] ?? null) || ! str_starts_with($book['release'] ?? '', $id.'.') || ! preg_match('/^[a-f0-9]{40}$/D', $book['source_commit'] ?? '')) {
                throw new RuntimeException('Invalid documentation version catalog.');
            }
        }

        return ['default' => (string) $manifest['default'], 'latest' => (string) $manifest['latest'], 'versions' => $manifest['versions'], 'redirects' => $manifest['redirects'] ?? []];
    }

    private function asset(string $root, string $source, string $resolved): array
    {
        $bytes = $this->read($root, $source, 8_000_000);
        $mime = (new \finfo(FILEINFO_MIME_TYPE))->buffer($bytes);
        $extensions = ['image/png' => 'png', 'image/jpeg' => 'jpg', 'image/webp' => 'webp', 'image/gif' => 'gif'];
        if (! isset($extensions[$mime])) {
            throw new RuntimeException("Unsupported image: {$source}");
        }
        $hash = hash('sha256', $bytes);
        if (file_exists($root.'/'.$source.'.capture.json')) {
            $capture = json_decode($this->read($root, $source.'.capture.json'), true, flags: JSON_THROW_ON_ERROR);
            if (($capture['schema'] ?? null) !== 1 || ! hash_equals($hash, (string) ($capture['sha256'] ?? ''))) {
                throw new RuntimeException("Image provenance does not match: {$source}");
            }
        }

        return ['source_path' => $resolved, 'hash' => $hash, 'storage_path' => 'docs/assets/'.$hash.'.'.$extensions[$mime], 'mime' => $mime, 'bytes' => $bytes];
    }

    private function read(string $root, string $path, int $limit = 250_000): string
    {
        $real = realpath($root.'/'.$path);
        if (! $real || ! str_starts_with($real, $root.'/') || ! is_file($real) || is_link($root.'/'.$path) || filesize($real) > $limit) {
            throw new RuntimeException("Missing, unsafe or oversized content: {$path}");
        }

        return file_get_contents($real);
    }

    private function resolve(string $slug, string $target): string
    {
        $path = str_starts_with($target, '/') ? ltrim($target, '/') : (dirname($slug) === '.' ? '' : dirname($slug).'/').$target;
        $parts = [];
        foreach (explode('/', $path) as $part) {
            if ($part === '..') {
                if (! $parts) {
                    throw new RuntimeException('Link escapes the content root.');
                } array_pop($parts);
            } elseif ($part !== '' && $part !== '.') {
                $parts[] = $part;
            }
        }

        return implode('/', $parts);
    }

    private function anchor(string $text): string
    {
        // Match the former VitePress 1.6 / @mdit-vue/shared anchor rules so
        // bookmarks to numbered headings and environment variables still work.
        $text = \Normalizer::normalize($text, \Normalizer::FORM_KD);
        $text = preg_replace('/[\x{0300}-\x{036f}\x{0000}-\x{001f}]/u', '', $text);
        $text = preg_replace('/[\x21-\x2f\x3a-\x40\x5b-\x60\x7b-\x7e\s“”‘’]+/u', '-', $text);
        $text = mb_strtolower(trim(preg_replace('/-+/', '-', $text), '-'));

        return preg_replace('/^(\d)/', '_$1', $text) ?: 'section';
    }

    private function nodeText(Node $node): string
    {
        if (method_exists($node, 'getLiteral')) {
            return $node->getLiteral();
        }

        return implode('', array_map(fn (Node $child) => $this->nodeText($child), iterator_to_array($node->children())));
    }

    private function plain(string $html): string
    {
        return trim(html_entity_decode(strip_tags(preg_replace('~</(?:p|li|tr|h[1-6]|pre|blockquote)>|<br\s*/?>~i', "\n", $html)), ENT_QUOTES | ENT_HTML5, 'UTF-8'));
    }
}
