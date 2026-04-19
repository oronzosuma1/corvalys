/**
 * Bootstrap shim — imported at the top of resources/js/app.js.
 *
 * Historically this file wires Axios + CSRF token, but Corvalys uses
 * Livewire + Inertia-less fetch calls that read the token from
 * <meta name="csrf-token">. We keep the file so the `import './bootstrap'`
 * line stays canonical (matches Laravel starter kits).
 */
