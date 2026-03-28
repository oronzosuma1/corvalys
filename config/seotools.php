<?php
/**
 * @see https://github.com/artesaos/seotools
 */

return [
    'inertia' => env('SEO_TOOLS_INERTIA', false),
    'meta' => [
        'defaults'       => [
            'title'        => false,
            'titleBefore'  => false,
            'description'  => 'AI tools and consulting for European SMEs. Invoice management, document approvals, AI Act compliance. Strategy. Experience. Identity.',
            'separator'    => ' — ',
            'keywords'     => ['AI', 'SME', 'European', 'consulting', 'AI Act', 'compliance', 'invoice', 'automation'],
            'canonical'    => 'full',
            'robots'       => 'index,follow',
        ],
        'webmaster_tags' => [
            'google'    => null,
            'bing'      => null,
            'alexa'     => null,
            'pinterest' => null,
            'yandex'    => null,
            'norton'    => null,
        ],
        'add_notranslate_class' => false,
    ],
    'opengraph' => [
        'defaults' => [
            'title'       => 'Corvalys — AI-first consultancy for European SMEs',
            'description' => 'AI tools and consulting for European SMEs. Invoice management, document approvals, AI Act compliance.',
            'url'         => null,
            'type'        => 'website',
            'site_name'   => 'Corvalys',
            'images'      => [],
        ],
    ],
    'twitter' => [
        'defaults' => [
            'card' => 'summary_large_image',
            'site' => '@corvalys',
        ],
    ],
    'json-ld' => [
        'defaults' => [
            'title'       => 'Corvalys — AI-first consultancy for European SMEs',
            'description' => 'AI tools and consulting for European SMEs. Invoice management, document approvals, AI Act compliance.',
            'url'         => 'full',
            'type'        => 'WebPage',
            'images'      => [],
        ],
    ],
];
