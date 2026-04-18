@props([
    'title' => null,
    'description' => null,
    'keywords' => null,
    'canonical' => null,
    'image' => null,
    'type' => 'website',
    'locale' => null,
    'alternates' => [],
    'article' => false,
    'publishedAt' => null,
    'modifiedAt' => null,
    'author' => null,
    'schema' => [],
    'noindex' => false,
])
@php
    $siteName = 'Corvalys';
    $defaultTitle = trim((string) __('seo.default.title')) ?: 'Corvalys — AI Consulting & Operational Improvement for European SMEs';
    $defaultDescription = trim((string) __('seo.default.description')) ?: 'Practical AI consulting for European SMEs. Assessment, implementation, and managed support. GDPR compliant, EU AI Act ready.';

    // Prefer a dedicated 1200x630 OG image if present; fall back to brand logo.
    $ogDefaultPath = public_path('images/og-default.png');
    $defaultImage = file_exists($ogDefaultPath)
        ? asset('images/og-default.png')
        : asset('images/logo-corvalys.png');
    $currentUrl = url()->current(); // without query string by default
    $appUrl = config('app.url');

    // Fallback to @section('title', ...) / @section('meta_description', ...) for
    // backward compatibility with pages that still use the section-based pattern.
    // NOTE: Blade's 2-arg @section(name, content) pre-escapes the value via e(),
    // so decode once to prevent double-escape when {{ }} re-escapes below.
    $sectionTitle = trim(html_entity_decode((string) \Illuminate\Support\Facades\View::yieldContent('title'), ENT_QUOTES | ENT_HTML5, 'UTF-8'));
    $sectionDescription = trim(html_entity_decode((string) \Illuminate\Support\Facades\View::yieldContent('meta_description'), ENT_QUOTES | ENT_HTML5, 'UTF-8'));

    $finalTitle = $title ?: ($sectionTitle !== '' ? $sectionTitle : $defaultTitle);
    $finalDescription = $description ?: ($sectionDescription !== '' ? $sectionDescription : $defaultDescription);

    $finalCanonical = $canonical ?? $currentUrl;
    // Force absolute URL (replace localhost with config('app.url') if needed)
    if (str_contains($finalCanonical, 'localhost') && !str_contains($appUrl, 'localhost')) {
        $finalCanonical = str_replace(url('/'), rtrim($appUrl, '/'), $finalCanonical);
    }

    // Auto-generate hreflang alternates from the current localized route if
    // the caller didn't pass them explicitly.
    if (empty($alternates)) {
        try {
            $alternates = \App\Support\LocalizedRoutes::alternatesFor();
        } catch (\Throwable $e) {
            $alternates = [];
        }
    }

    $finalImage = $image ?? $defaultImage;
    if (!str_starts_with($finalImage, 'http')) {
        $finalImage = url($finalImage);
    }

    $finalLocale = $locale ?? app()->getLocale();
    $localeMap = ['en' => 'en_US', 'it' => 'it_IT', 'fr' => 'fr_FR'];
    $ogLocale = $localeMap[$finalLocale] ?? 'en_US';
@endphp
{{-- Basic --}}
<title>{{ $finalTitle }}</title>
<meta name="description" content="{{ $finalDescription }}">
@if($keywords)<meta name="keywords" content="{{ $keywords }}">@endif
@if($author)<meta name="author" content="{{ $author }}">@endif
@if($noindex)<meta name="robots" content="noindex,nofollow">@else<meta name="robots" content="index,follow">@endif

{{-- Canonical --}}
<link rel="canonical" href="{{ $finalCanonical }}">

{{-- Hreflang alternates --}}
@if(!empty($alternates))
    @foreach($alternates as $lang => $url)
        <link rel="alternate" hreflang="{{ $lang }}" href="{{ $url }}">
    @endforeach
    <link rel="alternate" hreflang="x-default" href="{{ $alternates['en'] ?? $finalCanonical }}">
@endif

{{-- Open Graph --}}
<meta property="og:title" content="{{ $finalTitle }}">
<meta property="og:description" content="{{ $finalDescription }}">
<meta property="og:url" content="{{ $finalCanonical }}">
<meta property="og:type" content="{{ $article ? 'article' : $type }}">
<meta property="og:site_name" content="{{ $siteName }}">
<meta property="og:image" content="{{ $finalImage }}">
<meta property="og:image:width" content="1200">
<meta property="og:image:height" content="630">
<meta property="og:locale" content="{{ $ogLocale }}">
@foreach(array_diff(['en', 'it', 'fr'], [$finalLocale]) as $altLang)
    <meta property="og:locale:alternate" content="{{ $localeMap[$altLang] ?? 'en_US' }}">
@endforeach

{{-- Article-specific --}}
@if($article && $publishedAt)<meta property="article:published_time" content="{{ \Carbon\Carbon::parse($publishedAt)->toIso8601String() }}">@endif
@if($article && $modifiedAt)<meta property="article:modified_time" content="{{ \Carbon\Carbon::parse($modifiedAt)->toIso8601String() }}">@endif
@if($article && $author)<meta property="article:author" content="{{ $author }}">@endif

{{-- Twitter --}}
<meta name="twitter:card" content="summary_large_image">
<meta name="twitter:title" content="{{ $finalTitle }}">
<meta name="twitter:description" content="{{ $finalDescription }}">
<meta name="twitter:image" content="{{ $finalImage }}">
<meta name="twitter:site" content="@corvalys">

{{-- PWA / Theme --}}
<meta name="theme-color" content="#0F7B6C">
<meta name="color-scheme" content="light">
<meta name="apple-mobile-web-app-capable" content="yes">
<meta name="apple-mobile-web-app-status-bar-style" content="default">
<meta name="apple-mobile-web-app-title" content="Corvalys">
<link rel="manifest" href="{{ asset('manifest.json') }}">

{{-- JSON-LD Organization (default) --}}
<script type="application/ld+json">
{!! json_encode([
    '@context' => 'https://schema.org',
    '@type' => 'Organization',
    'name' => 'Corvalys',
    'url' => $appUrl,
    'logo' => asset('images/logo-corvalys.png'),
    'sameAs' => ['https://www.linkedin.com/company/corvalysholding']
], JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE) !!}
</script>

{{-- Additional schema (if provided) --}}
@foreach($schema as $schemaItem)
<script type="application/ld+json">
{!! json_encode($schemaItem, JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE) !!}
</script>
@endforeach
