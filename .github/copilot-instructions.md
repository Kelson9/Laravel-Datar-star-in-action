# Copilot Instructions for Laravel + Datastar Workshop

## Project Overview
This is a **Laravel 12 workshop project** focused on learning [Datastar](https://data-star.dev/) - a hypermedia framework for building reactive UIs without heavy JavaScript frameworks. The project contains interactive examples/exercises (snake game, todo list, sortable tables, quiz) demonstrating Datastar's reactive patterns.

## Architecture & Key Patterns

### Frontend: Datastar-Driven Reactivity
- **No Vue/React**: All interactivity uses Datastar via `data-*` attributes in Blade templates
- **Datastar is vendored**: The library lives at `public/datastar.js` (v1.0.0-RC.6), not npm
- **Standard pattern** in all views:
  ```php
  <script type="module" src="{{ asset('datastar.js') }}"></script>
  ```
- **Reactive state** via `data-signals="{}"` attribute with JavaScript object syntax
- **Event handlers** via `data-on:*` attributes (e.g., `data-on:click`, `data-on:keydown__window`)
- **Effects** via `data-effect` for side effects and DOM manipulation
- **Computed values** via `data-computed:*` for derived state
- **Debugging**: Views include `<pre data-json-signals></pre>` to visualize reactive state

### Blade Views Architecture
- Each view is a **self-contained example** with embedded `<script>` tags containing vanilla JS helper functions
- No shared JS modules - functions like `drawGrid()`, `snakeMove()`, `addTodo()` are defined inline per view
- Views are in `resources/views/` and referenced directly in routes (e.g., `return view('snakeGame')`)

### Backend: Minimal Laravel
- **Single route**: `routes/web.php` returns `view('snakeGame')` - extremely simple, no controllers
- **SQLite database** (default via `.env.example`)
- **No backend API** - this is purely a frontend Datastar learning project
- Sessions/queue/cache use database driver

### Styling: Tailwind CSS v4
- Uses **Tailwind v4** with Vite plugin: `@tailwindcss/vite`
- CSS at `resources/css/app.css` with `@import 'tailwindcss'`
- Custom theme configuration via `@theme` directive in app.css
- **Dynamic classes** in Datastar (e.g., `` `grid grid-cols-${$box_size}` ``) work with Tailwind's JIT

## Development Workflow

### Starting the App
**Use the custom composer script** (not `php artisan serve` alone):
```bash
composer dev
```
This runs a concurrent multi-process setup:
- PHP dev server (port 8000)
- Queue worker
- Log viewer (pail)
- Vite dev server for hot reload

Individual commands:
```bash
php artisan serve      # Just the web server
npm run dev           # Just Vite for asset compilation
```

### Setup from Scratch
```bash
composer setup   # Installs deps, generates key, migrates, builds assets
```

### Testing
```bash
composer test    # Clears config + runs PHPUnit
```

## Conventions & Gotchas

### When Adding New Datastar Examples
1. Create a new Blade view in `resources/views/`
2. Include the standard head with `@vite()` and Datastar script
3. Define signals in `data-signals="{}"` on a container div
4. Write helper functions in inline `<script>` tags (not external files)
5. Add debug `<pre data-json-signals></pre>` at the end
6. Update `routes/web.php` to route to your new view

### Datastar-Specific Patterns Observed
- **Grid rendering**: See `snakeGame.blade.php` - `data-effect` calls `drawGrid()` to imperatively create DOM
- **Intervals**: `data-on-interval__duration.500ms` for game loops
- **Window events**: `data-on:keydown__window` for global keyboard handlers
- **Dynamic styling**: `data-style:width` and `data-style:height` for computed CSS
- **String interpolation** in data attributes uses backticks: `` `${$variable}` ``

### File Organization
- **No controllers** - all logic is in views or would be routes/closures
- **No models used** - User model exists but unused in this workshop
- **No API routes** - only `routes/web.php`

### Dependencies
- **Laravel 12** (PHP 8.2+)
- **Tailwind v4** (major version change from v3 - uses `@import` not `@tailwind` directives)
- **SQLite** for local dev (no MySQL needed)
- **Concurrently** (npm) to run multi-process dev environment

## Common Tasks

### Adding a New Interactive Example
Create `resources/views/my-example.blade.php`:
```php
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My Example</title>
    @vite(['resources/js/app.js', 'resources/css/app.css'])
    <script type="module" src="{{ asset('datastar.js') }}"></script>
</head>
<body>
    <div data-signals="{count: 0}">
        <button data-on:click="$count++" class="bg-blue-500 px-4 py-2 rounded">
            Clicked <span data-text="$count"></span> times
        </button>
    </div>
    <script>
        // Helper functions here
    </script>
    <pre data-json-signals></pre>
</body>
</html>
```

Update `routes/web.php`:
```php
Route::get('/my-example', function () {
    return view('my-example');
});
```

### Updating Datastar Version
Replace `public/datastar.js` with the new version from [data-star.dev](https://data-star.dev/)

### Modifying Styles
Edit `resources/css/app.css` - Vite will hot-reload. Use Tailwind classes in Blade templates.

## References
- [Datastar Documentation](https://data-star.dev/)
- [Laravel 12 Docs](https://laravel.com/docs/12.x)
- [Tailwind CSS v4](https://tailwindcss.com/docs)
