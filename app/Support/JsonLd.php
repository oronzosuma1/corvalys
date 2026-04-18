<?php

namespace App\Support;

/**
 * Schema.org JSON-LD builders. All URLs read config('app.url') so the
 * emitted snippets are portable across local/staging/production.
 */
class JsonLd
{
    public static function organization(): array
    {
        $host = rtrim(config('app.url'), '/');
        return [
            '@context' => 'https://schema.org',
            '@type' => 'Organization',
            'name' => 'Corvalys',
            'url' => $host,
            'logo' => $host . '/images/logo-corvalys.png',
            'sameAs' => [
                'https://www.linkedin.com/company/corvalysholding',
            ],
            'contactPoint' => [[
                '@type' => 'ContactPoint',
                'contactType' => 'customer support',
                'email' => 'info@corvalys.eu',
                'availableLanguage' => ['en', 'it', 'fr'],
            ]],
        ];
    }

    public static function website(): array
    {
        $host = rtrim(config('app.url'), '/');
        return [
            '@context' => 'https://schema.org',
            '@type' => 'WebSite',
            'url' => $host,
            'name' => 'Corvalys',
            'inLanguage' => ['en', 'it', 'fr'],
            'potentialAction' => [
                '@type' => 'SearchAction',
                'target' => $host . '/blog?q={search_term_string}',
                'query-input' => 'required name=search_term_string',
            ],
        ];
    }

    /**
     * @param array<array{name:string,url:string}> $items
     */
    public static function breadcrumbs(array $items): array
    {
        $positions = array_keys($items);
        return [
            '@context' => 'https://schema.org',
            '@type' => 'BreadcrumbList',
            'itemListElement' => array_map(
                fn ($i, $idx) => [
                    '@type' => 'ListItem',
                    'position' => $idx + 1,
                    'name' => $i['name'],
                    'item' => $i['url'],
                ],
                $items,
                $positions
            ),
        ];
    }

    /**
     * @param array $p  keys: name, description, image, url, sku, priceCurrency?, price?, availability?
     */
    public static function product(array $p): array
    {
        return [
            '@context' => 'https://schema.org',
            '@type' => 'Product',
            'name' => $p['name'],
            'description' => $p['description'] ?? '',
            'image' => $p['image'] ?? self::defaultImage(),
            'sku' => $p['sku'] ?? null,
            'brand' => ['@type' => 'Brand', 'name' => 'Corvalys'],
            'offers' => [
                '@type' => 'Offer',
                'url' => $p['url'],
                'priceCurrency' => $p['priceCurrency'] ?? 'EUR',
                'price' => $p['price'] ?? '0',
                'availability' => $p['availability'] ?? 'https://schema.org/PreOrder',
            ],
        ];
    }

    /**
     * @param array $a  keys: headline, description, image?, url, datePublished, dateModified?, author?, inLanguage
     */
    public static function article(array $a): array
    {
        $host = rtrim(config('app.url'), '/');
        return [
            '@context' => 'https://schema.org',
            '@type' => 'BlogPosting',
            'headline' => $a['headline'],
            'description' => $a['description'] ?? '',
            'image' => $a['image'] ?? self::defaultImage(),
            'datePublished' => $a['datePublished'] ?? null,
            'dateModified' => $a['dateModified'] ?? ($a['datePublished'] ?? null),
            'inLanguage' => $a['inLanguage'] ?? app()->getLocale(),
            'mainEntityOfPage' => $a['url'],
            'author' => [
                '@type' => 'Organization',
                'name' => $a['authorName'] ?? 'Corvalys',
                'url' => $host,
            ],
            'publisher' => [
                '@type' => 'Organization',
                'name' => 'Corvalys',
                'logo' => [
                    '@type' => 'ImageObject',
                    'url' => $host . '/images/logo-corvalys.png',
                ],
            ],
        ];
    }

    /**
     * @param array<array{q:string,a:string}> $faqs
     */
    public static function faqPage(array $faqs): array
    {
        return [
            '@context' => 'https://schema.org',
            '@type' => 'FAQPage',
            'mainEntity' => array_map(fn ($f) => [
                '@type' => 'Question',
                'name' => $f['q'],
                'acceptedAnswer' => ['@type' => 'Answer', 'text' => $f['a']],
            ], $faqs),
        ];
    }

    public static function contactPage(string $url, string $name = 'Contact Corvalys'): array
    {
        return [
            '@context' => 'https://schema.org',
            '@type' => 'ContactPage',
            'url' => $url,
            'name' => $name,
        ];
    }

    protected static function defaultImage(): string
    {
        $host = rtrim(config('app.url'), '/');
        return $host . '/images/og-default.png';
    }
}
