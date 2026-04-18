<?= '<?xml version="1.0" encoding="UTF-8"?>' . "\n" ?>
<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9"
        xmlns:xhtml="http://www.w3.org/1999/xhtml">
@foreach($entries as $e)
    <url>
        <loc>{{ $e['loc'] }}</loc>
@if(!empty($e['lastmod']))
        <lastmod>{{ $e['lastmod'] }}</lastmod>
@endif
        <changefreq>{{ $e['changefreq'] }}</changefreq>
        <priority>{{ $e['priority'] }}</priority>
@foreach($e['alternates'] as $hl => $href)
@if($href)
        <xhtml:link rel="alternate" hreflang="{{ $hl }}" href="{{ $href }}"/>
@endif
@endforeach
    </url>
@endforeach
</urlset>
