# AGENTS.md

This file provides guidance to WARP (warp.dev) when working with code in this repository.

## Development Commands

```powershell
# Start all services (server, queue, logs, vite) concurrently
composer dev

# Run test suite with Pest
./vendor/bin/pest

# Run single test file
./vendor/bin/pest tests/Feature/ExampleTest.php

# Run tests matching a name
./vendor/bin/pest --filter="test name"

# PHP code formatting (Laravel Pint)
./vendor/bin/pint

# Frontend formatting (Prettier)
npm run format

# Check frontend formatting without changes
npm run format:check

# Build frontend for production
npm run build
```

## Architecture Overview

### Stack
- **Backend**: Laravel 12, PHP 8.4, Inertia.js
- **Frontend**: Vue 3 + TypeScript, Tailwind CSS v4, Vite
- **Testing**: Pest (Feature tests use RefreshDatabase trait)

### Project Structure

The application has two main code areas:

**1. Main Application (`app/`)**
- Standard Laravel structure with controllers organized by domain
- Control panel routes prefixed with `cp.` under `/cp/*`

**2. Site Builder Package (`packages/maximianac/site-builder/`)**
- Self-contained package with namespace `Maximianac\SiteBuilder`
- Contains the modular CMS functionality

### Module System

Modules live in `packages/maximianac/site-builder/src/Services/Modules/`. Each module must follow this structure:

```
ModuleName/
├── ModuleNameModule.php          # Main module class
├── ModuleNameServiceProvider.php # Extends BaseModuleServiceProvider
├── app/
│   ├── Data/                     # Spatie Data classes
│   ├── Http/Controllers/         # Web and API controllers
│   └── Models/                   # Module-specific models
├── routes/                       # Module routes
└── stubs/resources/views/        # Blade views (prefix: sb-modulename)
```

Module service providers extend `BaseModuleServiceProvider` and implement:
- `getModuleName()` - Returns module identifier
- `mapRoutes()` - Registers web routes under `cp/modules/{modulename}`
- `mapApiRoutes()` - Registers API routes

Modules are auto-discovered by `SiteBuilderServiceProvider` and registered in `config/site-builder.php`.

### Frontend Organization

```
resources/js/
├── pages/           # Inertia pages (resolved from ./pages/{name}.vue)
├── components/
│   ├── ui/          # Shadcn-vue base components (reka-ui)
│   ├── cp/          # Control panel components
│   └── sb/          # Site builder components
├── composables/     # Vue composables
├── layouts/         # Page layouts
└── wayfinder/       # Auto-generated route helpers (Laravel Wayfinder)
```

### Data Transfer

- **Backend DTOs**: Use Spatie Laravel Data classes (`packages/.../Data/`)
- **Frontend Forms**: VeeValidate + Zod for validation, TanStack Form
- **Route Generation**: Ziggy (backend routes) + Wayfinder (typed route helpers)

### Core Models

Located in `packages/maximianac/site-builder/src/Models/`:
- `Page`, `Panel`, `PanelField` - Page content structure
- `Content`, `ContentEntry` - Content management
- `Translation` - i18n support (configured locales: en, ru)
- `Module` - Module registry

### Key Packages

- `spatie/laravel-data` - Data transfer objects
- `spatie/laravel-medialibrary` - File/media handling
- `spatie/laravel-translatable` - Model translations
- `spatie/laravel-sluggable` - URL slug generation
- `inertiajs/inertia-laravel` + `@inertiajs/vue3` - SPA bridge
- `tightenco/ziggy` - Laravel routes in JavaScript
