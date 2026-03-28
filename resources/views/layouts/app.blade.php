<!DOCTYPE html>
<html lang="en" x-bind:lang="$store.lang.current" class="scroll-smooth">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    {!! \Artesaos\SEOTools\Facades\SEOTools::generate() !!}
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @livewireStyles
</head>
<body class="font-body bg-white text-gray-900 antialiased" x-data="{}">
    {{-- AI Act Banner --}}
    <div x-data="{ show: true }" x-show="show" x-cloak
        class="bg-amber text-white text-sm py-2.5 px-4 text-center relative">
        <span data-i18n="banner.text">Act now: on August 2, 2026, the AI Act becomes mandatory for SMEs using AI.</span>
        <a href="/consulenza" class="underline font-semibold ml-2 hover:text-amber-light"><span data-i18n="banner.link">Learn what to do &rarr;</span></a>
        <button @click="show = false" class="absolute right-4 top-1/2 -translate-y-1/2 text-white/80 hover:text-white text-lg">&times;</button>
    </div>

    <x-navbar />

    <main>
        @yield('content')
    </main>

    <x-footer />

    @livewireScripts
</body>
</html>
