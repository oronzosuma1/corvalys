<?= '<?xml version="1.0" encoding="UTF-8"?>' . "\n" ?>
<rss version="2.0" xmlns:atom="http://www.w3.org/2005/Atom">
<channel>
    <title>Corvalys Blog</title>
    <link>{{ $base }}</link>
    <description>AI consulting insights from Corvalys</description>
    <language>{{ $locale }}</language>
    <atom:link href="{{ $selfUrl }}" rel="self" type="application/rss+xml"/>
    @foreach($items as $item)
    <item>
        <title><![CDATA[{{ $item['title'] }}]]></title>
        <link>{{ $item['link'] }}</link>
        <guid isPermaLink="true">{{ $item['guid'] }}</guid>
        <description><![CDATA[{{ $item['description'] }}]]></description>
        <pubDate>{{ $item['pubDate'] }}</pubDate>
        @if(!empty($item['image']))
        <enclosure url="{{ $item['image'] }}" type="image/png"/>
        @endif
    </item>
    @endforeach
</channel>
</rss>
