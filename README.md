# Blackcube Demo — Yii3

Demonstration application for [Blackcube CMS](https://www.blackcube.io) on Yii3. Use as a starting point with `composer create-project`.

[![License](https://img.shields.io/badge/license-BSD--3--Clause-blue.svg)](LICENSE.md)

## What this is

A **starter** — a point of departure, not a framework to follow.

Blackcube gives you **content**: structured entities ([dcore](https://github.com/blackcubeio/dcore)), an admin panel to manage them ([dboard](https://github.com/blackcubeio/dboard)), and routing that hands each public URL to your code ([ssr](https://github.com/blackcubeio/ssr)). It ships no theme and no templates. This is not WordPress.

Everything under `src/` — handlers, views, helpers, widgets — is just **one example** of how to render that content, here to get you running. **Modify it, replace it, or throw it away** and build the site you need. There is no required structure and no rendering model to respect: the content comes from Blackcube, every choice about how to display it is yours.

## What's included

Example handlers, ready to adapt or replace:

| Handler | Route | Role |
|---|---|---|
| `LandingHandler` | `landing` | landing page |
| `NotFoundHandler` | `not-found` | 404 error page |
| `ServerErrorHandler` | `server-error` | 5xx error page |
| `RedirectLangHandler` | `redirect-lang` | language redirect at the root (`/` -> `/fr`) |

Alongside them: example views (`src/Views`), block widgets (`src/Widgets`),
helpers (`src/Helpers`) and the handler base classes (`src/Commons`). All of it
is a starting point — keep what fits, change the rest.

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

The oauth2 keys are generated on first use, in the directory named by
`OAUTH2_PUBLIC_KEY` / `OAUTH2_PRIVATE_KEY` (`config/keys/` by default), so there
is nothing to do here. To bring your own instead, drop them there before the
first request:

```bash
# private key (2048 bits minimum, 4096 recommanded)
openssl genpkey -algorithm RSA -out private.pem -pkeyopt rsa_keygen_bits:4096

# public key
openssl rsa -in private.pem -pubout -out public.pem
```


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

## License

BSD-3-Clause. See [LICENSE.md](LICENSE.md).

## Author

Philippe Gaultier <philippe@blackcube.io>
