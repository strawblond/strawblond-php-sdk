# CLAUDE.md

This file provides guidance to Claude Code (claude.ai/code) when working with code in this repository.

## Overview

PHP SDK (PHP 8.1+) for the Blond API (`https://api.blond.swiss/api`), built on [Saloon v3](https://docs.saloon.dev/). Saloon is the only dependency. There are no tests, linters, or CI in this repo — the only setup command is `composer install`.

The product rebranded from StrawBlond to Blond (blond.swiss) in 2026, but **the package name (`strawblond/strawblond-php-sdk`) and the `StrawBlond\` PHP namespace are intentionally kept for backwards compatibility — do not rename them.** The old API host `api.strawblond.com` also still works, and the developer docs still live at https://developers.strawblond.com/.

## Architecture

Three layers, all under the `StrawBlond\` namespace (PSR-4 from `src/`):

- **`src/StrawBlond.php`** — the Saloon `Connector`. Holds the base URL, token auth, and default headers. Exposes one factory method per resource (`$api->invoice()`, `$api->contact()`, …). Adding a new resource means adding a method here.

- **`src/Resources/`** — resource classes extending Saloon's `BaseResource`. Most extend `CrudResource`, which provides `create` / `get` / `all` / `update` / `delete` by sending generic requests parameterized by an abstract `getResource(): string` (the API endpoint slug, e.g. `'invoice'`). Subclasses add convenience methods (e.g. `InvoiceResource::paid()` pre-fills a status filter, `send()` dispatches a dedicated request). Non-CRUD resources (`UserResource`, singleton-style) extend `BaseResource` directly with their own request classes.

- **`src/Requests/`** — Saloon `Request` classes. The five generic `*ResourceRequest` classes take the resource slug in their constructor and serve all CRUD resources; special operations (e.g. `SendInvoiceRequest`, `GetUserRequest`) get their own class.

Query-string conventions live in `AllResourceRequest::defaultQuery()`: filters become `filter[key]=value`, includes are comma-joined under `include`, plus `sort` and `page`. `DocumentElementResource` is the one scoped resource — it's constructed with a document type/id and overrides `all()` to map `'invoice'`/`'offer'` to fully-qualified backend class names for the `document_type` filter. Those backend class names (`Modules\Salesforce\*`) are internal API identifiers, not branding — don't rename them either.

All resource methods return Saloon `Response` objects; callers use `->json()`, `->collect()`, etc. The SDK does not define model/DTO classes.

When adding a resource or method, keep the public API in sync with the README's resource list and method tables, and with the API docs.
