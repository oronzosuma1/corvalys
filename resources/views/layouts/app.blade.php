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
    @stack('head')

    {{-- Sitewide structured data --}}
    <x-json-ld :data="\App\Support\JsonLd::organization()" />
    <x-json-ld :data="\App\Support\JsonLd::website()" />
</head>
<body class="min-h-screen flex flex-col">

    <x-navbar />

    <main class="flex-1">
        @yield('content')
    </main>

    <x-footer />

    <x-cookie-consent />
    <x-cookie-preferences-button />

    {{-- @livewireScriptConfig (no auto-start): our resources/js/app.js
         imports Livewire ESM and calls Livewire.start() manually.
         This is the single Alpine boot path. --}}
    @livewireScriptConfig
    @stack('scripts')
</body>
</html>
