<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}" class="scroll-smooth">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    {{-- SEO Head (single source of truth) --}}
    <x-seo-head
        :title="$seoTitle ?? null"
        :description="$seoDescription ?? null"
        :keywords="$seoKeywords ?? null"
        :canonical="$seoCanonical ?? null"
        :image="$seoImage ?? null"
        :type="$seoType ?? 'website'"
        :alternates="$seoAlternates ?? []"
        :schema="$seoSchema ?? []"
        :article="$seoArticle ?? false"
        :publishedAt="$seoPublishedAt ?? null"
        :modifiedAt="$seoModifiedAt ?? null"
        :author="$seoAuthor ?? null"
        :noindex="$seoNoindex ?? false"
    />

    {{-- Favicons --}}
    <link rel="icon" type="image/png" sizes="32x32" href="{{ asset('favicon-32.png') }}">
    <link rel="icon" type="image/png" sizes="16x16" href="{{ asset('favicon-16.png') }}">
    <link rel="apple-touch-icon" sizes="200x200" href="{{ asset('images/logo-corvalys.png') }}">
    <link rel="shortcut icon" href="{{ asset('favicon-32.png') }}">

    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @livewireStyles
    <script defer src="https://cdn.jsdelivr.net/npm/@alpinejs/intersect@3/dist/cdn.min.js"></script>
    <script defer src="https://cdn.jsdelivr.net/npm/@alpinejs/collapse@3/dist/cdn.min.js"></script>
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3/dist/cdn.min.js"></script>
    @stack('head')
</head>
<body class="min-h-screen flex flex-col">

    <x-navbar />

    <main class="flex-1">
        @yield('content')
    </main>

    <x-footer />

    <x-cookie-banner />
    <x-cookie-preferences-button />

    @livewireScripts
    @stack('scripts')
</body>
</html>
