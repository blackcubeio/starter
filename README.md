# Blackcube Demo — Yii3

Demonstration application for [Blackcube CMS](https://www.blackcube.io) on Yii3. Use as a starting point with `composer create-project`.

[![License](https://img.shields.io/badge/license-BSD--3--Clause-blue.svg)](LICENSE.md)

## Requirements

- PHP 8.4+
- MySQL / MariaDB
- Composer
- Node.js (for frontend assets)

## Installation

```bash
composer create-project blackcube/starter my-project
cd my-project
cp .env.example .env
```

Create oauth2 keys:

```bash
# private key (2048 bits minimum, 4096 recommanded)
openssl genpkey -algorithm RSA -out private.pem -pkeyopt rsa_keygen_bits:4096

# public key
openssl rsa -in private.pem -pubout -out public.pem
```
and copy the keys in `config/keys/`


Edit `.env` with your database credentials:

```env
DB_DRIVER=mysql
DB_HOST=localhost
DB_PORT=3306
DB_DATABASE=myapp
DB_USER=myapp
DB_PASSWORD=myapp
```

and all needed conf vars 

Run the migrations:

```bash
php yii.php migrate:up
```

## Stack

- [blackcube/dcore](https://github.com/blackcubeio/dcore) — data layer (entities, slugs, SEO)
- [blackcube/dboard](https://github.com/blackcubeio/dboard) — administration panel
- [blackcube/ssr](https://github.com/blackcubeio/ssr) — server-side routing and rendering

## Configuration

### Parameters — `config/common/params.php`

```php
'blackcube/ssr' => [
    'scanAttributes' => true,
    'scanAliases' => ['@src/Handlers'],
],
```

| Parameter | Description |
|---|---|
| `scanAttributes` | Scan handler classes for `#[RoutingHandler]` attributes |
| `scanAliases` | Yii aliases pointing to directories containing handlers |

### Middleware — `config/web/di/application.php`

```php
SsrRoutingMiddlewareInterface::class => YiiSsrRoutingMiddleware::class,
```

```php
static function (SsrRoutingMiddlewareInterface $middleware) use ($params): SsrRoutingMiddlewareInterface {
    return $middleware
        // ->withExcludedPrefixes('dboard/', 'api/graphql')
        ->withXeo()
        ->withMdAlternate();
},
```

Pipeline order:

```
ErrorCatcher → Session → CookieLogin → CSRF → SsrRoutingMiddleware → Router
```

## Handlers

A handler renders CMS content. The SSR middleware resolves the handler via the Type's `handler` field: a Type with `handler: 'article'` dispatches to the class carrying `#[RoutingHandler(route: 'article')]`.

Place handler classes in `src/Handlers/`:

```php
#[RoutingHandler(route: 'landing')]
final class LandingHandler implements RequestHandlerInterface
{
    public function __construct(
        private readonly Content|Tag $element,
        private readonly WebViewRenderer $viewRenderer,
    ) {}

    public function handle(ServerRequestInterface $request): ResponseInterface
    {
        // $this->element is the Content or Tag resolved from the slug
        // $this->viewRenderer carries Xeo injections (meta, OG, JSON-LD)
    }
}
```

The CMS entity and Yii services are injected in the constructor. The request is passed to `handle()`.

### Error handlers

```php
#[RoutingHandler(route: 'not-found', errorCode: 404)]
final class NotFoundHandler implements RequestHandlerInterface { }

#[RoutingHandler(route: 'server-error', errorCodesRange: [500, 599])]
final class ServerErrorHandler implements RequestHandlerInterface { }
```

## Special routes

Handled automatically by the SSR package — no code needed:

| Route | Content-Type | Source |
|---|---|---|
| `/sitemap.xml` | `application/xml` | Active CMS slugs with sitemap metadata |
| `/robots.txt` | `text/plain` | GlobalXeo "Robots" entry |
| `/llms.txt` | `text/plain` | LlmMenu navigation tree |
| `/llms-full.txt` | `text/plain` | LlmMenu tree with full markdown content |
| `/{slug}.md` | `text/markdown` | Markdown export of any CMS page |
| Redirects | 301/302 | Slugs with a target URL |

## License

BSD-3-Clause. See [LICENSE.md](LICENSE.md).

## Author

Philippe Gaultier <philippe@blackcube.io>
