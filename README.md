# InvoiceShelf Documentation

Official documentation for InvoiceShelf built with VitePress.

## Development

```bash
# Install dependencies
yarn install

# Start development server
yarn dev

# Build documentation
yarn build

# Preview production build
yarn serve
```

## Docker

### Using Docker Compose

Run the documentation site locally:

```bash
docker-compose up -d
```

The site will be available at `http://localhost:8001`

### Building Docker Image

```bash
docker build -t invoiceshelf/docs .
```

## Deployment

Documentation is automatically built and published to GitHub Container Registry on every push to master.

Images are available at:
- `ghcr.io/invoiceshelf/docs:latest` - Latest master branch
- `ghcr.io/invoiceshelf/docs:<commit-sha>` - Specific commit builds
