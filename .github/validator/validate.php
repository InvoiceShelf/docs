<?php
// Exported by website docs:export-validator; do not maintain a second parser here.
require __DIR__.'/vendor/autoload.php';
require __DIR__.'/ContentParser.php';
$source = json_decode(file_get_contents(__DIR__.'/source.json'), true, flags: JSON_THROW_ON_ERROR);
if (! hash_equals($source['sha256'], hash_file('sha256', __DIR__.'/ContentParser.php'))) {
    throw new RuntimeException('Validator checksum mismatch. Re-export from the website source.');
}
$content = (new App\Services\Docs\ContentParser)->parse($argv[1] ?? dirname(__DIR__, 2));
printf("Validated %d documents and %d assets.\n", count($content['documents']), count($content['assets']));