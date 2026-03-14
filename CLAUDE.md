# CLAUDE.md

This file provides guidance to Claude Code (claude.ai/code) when working with code in this repository.

## Development Commands

### Running the Application

**Development mode** (runs Laravel server, queue worker, logs, and Vite bundler concurrently):
```bash
composer run dev
```

**Vite development server only** (for frontend assets):
```bash
npm run dev
```

**Production build** (for frontend assets):
```bash
npm run build
```

**Laravel development server** (without other services):
```bash
php artisan serve
```

### Database & Migrations

**Run migrations:**
```bash
php artisan migrate
```

**Rollback migrations:**
```bash
php artisan migrate:rollback
```

**Fresh database** (rollback all and re-run):
```bash
php artisan migrate:fresh
```

**Seed database:**
```bash
php artisan db:seed
```

### Testing

**Run all tests:**
```bash
php artisan test
```

**Run tests with compact output:**
```bash
php artisan test --compact
```

**Run specific test file:**
```bash
php artisan test --filter=FeatureTestName
```

**Run unit tests only:**
```bash
php artisan test --compact tests/Unit
```

**Run feature tests only:**
```bash
php artisan test --compact tests/Feature
```

### Code Quality

**Format code with Pint:**
```bash
vendor/bin/pint
```

**Check formatting without fixing:**
```bash
vendor/bin/pint --test
```

**Format only changed files:**
```bash
vendor/bin/pint --dirty
```

### Artisan Utilities

**Create migrations:**
```bash
php artisan make:migration MigrationName
```

**Create models (with factory and seeder):**
```bash
php artisan make:model ModelName -mfs
```

**Create Livewire components:**
```bash
php artisan make:livewire ComponentName
```

**Create tests:**
```bash
php artisan make:test TestName --pest
```

**Create unit tests:**
```bash
php artisan make:test TestName --pest --unit
```

## Project Architecture

### High-Level Structure

This is a **Laravel 12 + Livewire 4 application** for a mosque website (Masjid Syatho Sedan) with a blog/article management system.

**Key Technologies:**
- **Backend:** Laravel 12, Livewire 4, Laravel Fortify (authentication)
- **Frontend:** Flux UI (component library), Tailwind CSS v4, Vite
- **Database:** SQLite (development), configurable for production
- **Testing:** Pest 4 PHP testing framework
- **Code Quality:** Laravel Pint for formatting

### Core Features

**Public Areas:**
- **Home Page** (`routes/web.php`, `resources/views/pages/home/index.blade.php`) — landing page
- **Blog/Articles** (`/artikel`) — public article listing and detail pages powered by Livewire

**Authenticated Areas** (require login + email verification):
- **Portal Dashboard** (`/portal`) — authenticated user dashboard
- **Article Management** (`/portal/artikel`) — CRUD interface for managing articles (create, edit, view list)
- **Account Settings** (`/settings`) — user profile and two-factor authentication settings

### Data Models

**Core Models:**
- **User** (`app/Models/User.php`) — application users with Fortify authentication
- **Artikel** (`app/Models/Artikel.php`) — blog articles with relationships:
  - `user` — author of the article
  - `kategori` — article category
  - `tags` — multiple tags (many-to-many)
  - Scopes: `diterbitkan()` (published articles), `unggulan()` (featured articles)
- **Kategori** (`app/Models/Kategori.php`) — article categories
- **Tag** (`app/Models/Tag.php`) — article tags

**Key Fields on Artikel:**
- `judul` — article title
- `slug` — URL slug
- `konten` — article body content
- `status` — publication status (diterbitkan/draft)
- `diterbitkan_pada` — publication timestamp
- `unggulan` — featured flag (boolean)
- `dilihat` — view count (integer)

### Directory Overview

```
app/
  ├── Models/              # Eloquent models (User, Artikel, Kategori, Tag)
  ├── Livewire/            # Livewire components organized by section
  │   └── Actions/         # Livewire actions
  ├── Http/Controllers/    # HTTP controllers (if needed)
  └── Actions/             # Reusable application actions
      └── Fortify/         # Fortify-specific actions

resources/
  └── views/
      ├── layouts/         # Layout templates
      ├── pages/           # Page components
      │   ├── home/        # Home page
      │   ├── artikel/     # Public article pages
      │   ├── portal/      # Authenticated portal
      │   │   └── artikel/ # Article management
      │   ├── dashboard/   # Dashboard page
      │   ├── auth/        # Authentication pages (Fortify)
      │   └── settings/    # Account settings pages
      └── components/      # Reusable Blade components

routes/
  ├── web.php              # Main web routes
  └── settings.php         # Settings/profile routes

database/
  ├── migrations/          # Database migrations
  ├── factories/           # Model factories for testing
  └── seeders/             # Database seeders

tests/
  ├── Feature/             # Feature tests (end-to-end flows)
  └── Unit/                # Unit tests (isolated logic)
```

### Routing Pattern

Routes are defined in `routes/web.php`:
- **Blade views:** `Route::view()` — static pages
- **Livewire pages:** `Route::livewire()` — dynamic interactive pages
- **Middleware groups:** `middleware(['auth', 'verified'])` — authenticated & email-verified users only

Example:
```php
Route::livewire('/artikel', 'pages::artikel.index')->name('blog');
```
This maps `/artikel` to a Livewire component in `resources/views/pages/artikel/index.blade.php`.

### Component Organization

**Livewire Components:**
- Located in `resources/views/pages/` organized by feature
- Use Flux UI (`<flux:*>`) components for consistent styling
- Use Tailwind CSS v4 utilities for custom styling
- State and reactivity handled server-side; use Alpine.js only when needed

**Blade Components:**
- Reusable partials in `resources/views/components/`
- Used within pages and layouts

### Testing Strategy

- **Pest** is the testing framework (`pestphp/pest` + `pestphp/pest-plugin-laravel`)
- **Feature tests** (`tests/Feature/`) — test full user workflows
- **Unit tests** (`tests/Unit/`) — test isolated logic
- **Factories** in `database/factories/` — generate test data
- **In-memory SQLite** — tests use SQLite in-memory database for speed

### Frontend Bundling

- **Vite** handles JavaScript and CSS bundling
- **Tailwind CSS v4** with `@tailwindcss/vite` plugin
- **Laravel Vite Plugin** — integrates Laravel with Vite
- Run `npm run dev` during development; Vite hot-reloads changes
- Run `npm run build` before deployment

## Key Files & Their Purposes

| File | Purpose |
|------|---------|
| `routes/web.php` | Define all web routes and page mappings |
| `bootstrap/app.php` | Application configuration (middleware, exception handling) |
| `composer.json` | PHP dependencies and scripts |
| `package.json` | Node.js dependencies and build scripts |
| `database/migrations/` | Database schema changes |
| `database/factories/` | Model factories for seeding and testing |
| `app/Models/` | Eloquent models with relationships |
| `AGENTS.md` | Comprehensive development guidelines and conventions |

## Common Workflows

### Adding a New Public Page

1. Create a Blade view in `resources/views/pages/`
2. Add route to `routes/web.php`: `Route::view('/page-name', 'pages.page-name')`
3. Link from navigation as needed

### Adding a New Interactive Feature

1. Create Livewire component: `php artisan make:livewire pages/feature-name`
2. Design the component template using Flux UI components
3. Add route: `Route::livewire('/feature', 'pages::feature-name')`
4. Write tests in `tests/Feature/` or `tests/Unit/`

### Writing Tests

1. Create test: `php artisan make:test FeatureName --pest`
2. Use factories to create test data: `Artikel::factory()->create()`
3. Run tests: `php artisan test --compact --filter=testName`
4. Check coverage as part of CI/CD

## Important Notes

- **AGENTS.md contains critical project guidelines** — refer to it for Laravel Boost, Livewire, Fortify, Flux UI, Pest, Tailwind, and PHP conventions
- **Frontend changes need bundling** — after CSS/JS changes, run `npm run dev` or `npm run build` for changes to reflect
- **Fortify handles authentication** — use Fortify guards and actions for auth-related features
- **Livewire is server-driven** — minimize client-side JavaScript; use wire:* directives for reactivity
- **All PHP code must follow Pint formatting** — run `vendor/bin/pint --dirty` before committing
- **Every code change must have tests** — update or create tests that verify the change works
