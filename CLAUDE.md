# CLAUDE.md

This file provides guidance to Claude Code (claude.ai/code) when working with code in this repository.

## Project

**Deliweb** backend: an e-commerce backend and REST API built on Laravel 12 (PHP ^8.2). It's an early-stage project: so far it's mostly the Jetstream scaffold plus an admin panel that's still being built. The team writes commit messages and the README in Spanish.

## Stack

- **Laravel 12** with the streamlined `bootstrap/app.php` config. There's no `Http/Kernel.php`; middleware and routing are configured in `bootstrap/app.php`.
- **Jetstream 5 (Livewire stack)** + **Fortify** for auth (login, registration, password reset, 2FA, passkeys, profile photos, account deletion). Feature flags are in `config/jetstream.php` and `config/fortify.php`. Teams, API tokens UI and email verification are **disabled**.
- **Sanctum** for API auth (`routes/api.php`, `auth:sanctum`).
- **Livewire 3**, **Tailwind CSS 3** (with forms and typography plugins), **Vite 6** via `laravel-vite-plugin`. The entry points are `resources/css/app.css` and `resources/js/app.js`.
- **Database**: the local `.env` uses MySQL (`DB_DATABASE=ecommerce`, XAMPP). `.env.example` defaults to SQLite. Sessions, cache and queue use the `database` driver.

## Commands

```bash
composer dev                 # serve + queue:listen + pail logs + vite, concurrently
php artisan serve            # app only (or use XAMPP Apache)
npm run dev                  # Vite dev server
npm run build                # production assets

php artisan migrate
php artisan test                                   # all tests
php artisan test --filter=AuthenticationTest       # single test class/method
php artisan test tests/Feature/RegistrationTest.php

./vendor/bin/pint            # code style (Laravel Pint)
```

Tests use PHPUnit 11 (`tests/Feature`, `tests/Unit`). In `phpunit.xml` the SQLite in-memory DB lines are **commented out**, so tests run against the DB configured in `.env` (MySQL). Tests that use `RefreshDatabase` will wipe that database. Uncomment the sqlite lines, or point to a separate test DB, before running tests against real data.

## Architecture

### Routing
- `routes/web.php`: public `/` (welcome) and the Jetstream `/dashboard` (`auth:sanctum`, `AuthenticateSession`, `verified`).
- `routes/api.php`: Sanctum-protected API (`/api/user` for now). The REST API endpoints go here.
- `routes/admin.php`: loaded from the `then:` callback in `bootstrap/app.php` with middleware `web` + `auth`, URL prefix `/admin`, and route-name prefix `admin.`. Routes defined here **already get both prefixes**, so don't repeat `/admin` or `admin.` in this file.

### Views / layouts
- Jetstream's class-based layouts: `App\View\Components\AppLayout` → `layouts.app`, and `GuestLayout` → `layouts.guest`. Use them as `<x-app-layout>` and `<x-guest-layout>`.
- Admin panel (work in progress): `App\View\Components\AdminLayout` (`<x-admin-layout>`), `resources/views/layouts/admin.blade.php`, partials in `resources/views/layouts/partials/admin/{navigation,sidebar}.blade.php`, and pages in `resources/views/admin/`. The partials are based on Flowbite markup.
- Jetstream UI components are in `resources/views/components/` (`x-button`, `x-input`, `x-modal`, etc.). Reuse them instead of writing new primitives.

### Auth customisation
- Fortify actions are in `app/Actions/Fortify/` (create user, reset/update password, update profile), and the Jetstream delete-user action is in `app/Actions/Jetstream/`. They're registered in `FortifyServiceProvider` and `JetstreamServiceProvider`.
- `App\Models\User` uses `HasApiTokens`, `HasProfilePhoto`, `TwoFactorAuthenticatable`.

## Known issues in the in-progress admin panel

These are uncommitted changes and were broken when this file was written. Check whether they've been fixed before you rely on them:

1. `routes/admin.php` defines `/admin` named `admin.dashboard`. With the group prefixes, that becomes URL `/admin/admin` and name `admin.admin.dashboard`. It should be `Route::get('/', ...)->name('dashboard')`.
2. `resources/views/admin/dashboard.balde.php` has a typo in its extension (`.balde.php`), so `view('admin.dashboard')` can't find it. Rename it to `dashboard.blade.php`.
3. `AdminLayout::render()` returns `view('components.admin')`, which doesn't exist. It should be `view('layouts.admin')`.
4. `layouts/admin.blade.php` includes `layout.partials.admin.*` (singular `layout`). The directory is `layouts`.
5. Both admin partials are copies of a full HTML document (`<!DOCTYPE>`, `<head>`, `@vite`, `@livewireStyles`). They should contain only the nav/sidebar fragment. They still have Flowbite demo content (logo, "Neil Sims"). Their classes (`bg-neutral-primary-soft`, `rounded-base`, `text-heading`, …) come from the Flowbite theme, which isn't installed. Flowbite isn't in `package.json` or `tailwind.config.js`, so these classes and the `data-drawer-*`/`data-dropdown-*` JS behaviours do nothing until Flowbite is added.
6. There are duplicate migrations: `2026_09_17_*` and `2026_09_18_*` both add the two-factor columns and create `passkeys`. The two-factor migrations don't check `hasColumn`, so a fresh `migrate` will probably fail on the second one. Delete one pair, unless both have already run in a shared DB.
