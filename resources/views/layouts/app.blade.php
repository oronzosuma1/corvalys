<!DOCTYPE html>
<html lang="en" class="scroll-smooth">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'Corvalys — AI for European SMEs')</title>
    <meta name="description" content="@yield('meta_description', 'AI tools and consulting for European SMEs. Manage invoices, automate approvals, prepare for AI Act compliance.')">
    {!! SEOMeta::generate() !!}
    {!! OpenGraph::generate() !!}
    {!! JsonLd::generate() !!}
    <link rel="icon" type="image/png" sizes="32x32" href="{{ asset('favicon-32.png') }}">
    <link rel="icon" type="image/png" sizes="16x16" href="{{ asset('favicon-16.png') }}">
    <link rel="apple-touch-icon" sizes="200x200" href="{{ asset('images/logo-corvalys.png') }}">
    <link rel="shortcut icon" href="{{ asset('favicon-32.png') }}">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @livewireStyles
    <script defer src="https://cdn.jsdelivr.net/npm/@alpinejs/intersect@3/dist/cdn.min.js"></script>
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3/dist/cdn.min.js"></script>
    @stack('head')
</head>
<body class="min-h-screen flex flex-col">

    <x-navbar />

    <main class="flex-1">
        @yield('content')
    </main>

    <x-footer />

    @livewireScripts
    @stack('scripts')
</body>
</html>
