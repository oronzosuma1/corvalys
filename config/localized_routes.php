<?php

return [
    // Supported locales (first is default, no URL prefix)
    'locales' => ['en', 'it', 'fr'],
    'default_locale' => 'en',

    // Route definitions. Each key becomes a base route name.
    // 'paths' = locale → URL slug (no leading slash, empty string = locale root)
    // 'controller' = [Controller::class, 'method']
    // 'method' = 'get' (default) or 'post'
    // 'redirects' = old URL patterns that 301 to this route's current-locale variant
    'routes' => [
        'home' => [
            'paths' => ['en' => '', 'it' => '', 'fr' => ''],
            'controller' => [\App\Http\Controllers\HomeController::class, 'index'],
        ],
        'consulenza' => [
            'paths' => ['en' => 'consulting', 'it' => 'consulenza', 'fr' => 'conseil'],
            'controller' => [\App\Http\Controllers\ConsulenzaController::class, 'index'],
            'redirects' => ['/consulenza' => 'it'],
        ],
        'chi-siamo' => [
            'paths' => ['en' => 'about', 'it' => 'chi-siamo', 'fr' => 'a-propos'],
            'controller' => [\App\Http\Controllers\ChiSiamoController::class, 'index'],
            'redirects' => ['/chi-siamo' => 'it'],
        ],
        'chi-siamo.missione' => [
            'paths' => ['en' => 'about/mission', 'it' => 'chi-siamo/missione', 'fr' => 'a-propos/mission'],
            'controller' => [\App\Http\Controllers\ChiSiamoController::class, 'missione'],
            'redirects' => ['/chi-siamo/missione' => 'it'],
        ],
        'chi-siamo.cosa-facciamo' => [
            'paths' => ['en' => 'about/what-we-do', 'it' => 'chi-siamo/cosa-facciamo', 'fr' => 'a-propos/ce-que-nous-faisons'],
            'controller' => [\App\Http\Controllers\ChiSiamoController::class, 'cosaFacciamo'],
            'redirects' => ['/chi-siamo/cosafacciamo' => 'it'],
        ],
        'chi-siamo.valori' => [
            'paths' => ['en' => 'about/values', 'it' => 'chi-siamo/valori', 'fr' => 'a-propos/valeurs'],
            'controller' => [\App\Http\Controllers\ChiSiamoController::class, 'valori'],
            'redirects' => ['/chi-siamo/valori' => 'it'],
        ],
        'chi-siamo.team' => [
            'paths' => ['en' => 'about/team', 'it' => 'chi-siamo/team', 'fr' => 'a-propos/equipe'],
            'controller' => [\App\Http\Controllers\ChiSiamoController::class, 'team'],
            'redirects' => ['/chi-siamo/team' => 'it'],
        ],
        'chi-siamo.partners' => [
            'paths' => ['en' => 'about/partners', 'it' => 'chi-siamo/partners', 'fr' => 'a-propos/partenaires'],
            'controller' => [\App\Http\Controllers\ChiSiamoController::class, 'partners'],
            'redirects' => ['/chi-siamo/partners' => 'it'],
        ],
        'prodotti' => [
            'paths' => ['en' => 'products', 'it' => 'prodotti', 'fr' => 'produits'],
            'controller' => [\App\Http\Controllers\ProdottiController::class, 'index'],
            'redirects' => ['/prodotti' => 'it'],
        ],
        'prodotti.show' => [
            'paths' => ['en' => 'products/{service:slug}', 'it' => 'prodotti/{service:slug}', 'fr' => 'produits/{service:slug}'],
            'controller' => [\App\Http\Controllers\ProdottiController::class, 'show'],
        ],
        'prezzi' => [
            'paths' => ['en' => 'pricing', 'it' => 'prezzi', 'fr' => 'tarifs'],
            'controller' => [\App\Http\Controllers\PrezziController::class, 'index'],
            'redirects' => ['/prezzi' => 'it'],
        ],
        'contatto' => [
            'paths' => ['en' => 'contact', 'it' => 'contatto', 'fr' => 'contact'],
            'controller' => [\App\Http\Controllers\ContattoController::class, 'index'],
            'redirects' => ['/contatto' => 'it'],
        ],
        'contatto.store' => [
            'paths' => ['en' => 'contact', 'it' => 'contatto', 'fr' => 'contact'],
            'controller' => [\App\Http\Controllers\ContattoController::class, 'store'],
            'method' => 'post',
        ],
        'partner' => [
            'paths' => ['en' => 'partners', 'it' => 'partner', 'fr' => 'partenaires'],
            'controller' => [\App\Http\Controllers\PartnerController::class, 'index'],
            'redirects' => ['/partner' => 'it'],
        ],
        'partner.store' => [
            'paths' => ['en' => 'partners', 'it' => 'partner', 'fr' => 'partenaires'],
            'controller' => [\App\Http\Controllers\PartnerController::class, 'store'],
            'method' => 'post',
        ],
        'risorse' => [
            'paths' => ['en' => 'resources', 'it' => 'risorse', 'fr' => 'ressources'],
            'controller' => [\App\Http\Controllers\RisorseController::class, 'index'],
            'redirects' => ['/risorse' => 'it'],
        ],
        'blog.index' => [
            'paths' => ['en' => 'blog', 'it' => 'blog', 'fr' => 'blog'],
            'controller' => [\App\Http\Controllers\BlogController::class, 'index'],
        ],
        'blog.show' => [
            'paths' => ['en' => 'blog/{slug}', 'it' => 'blog/{slug}', 'fr' => 'blog/{slug}'],
            'controller' => [\App\Http\Controllers\BlogController::class, 'show'],
        ],
        'privacy' => [
            'paths' => ['en' => 'legal/privacy', 'it' => 'legale/privacy', 'fr' => 'legal/confidentialite'],
            'controller' => [\App\Http\Controllers\LegalController::class, 'privacy'],
            'redirects' => ['/legal/privacy' => 'it'],
        ],
        'cookie' => [
            'paths' => ['en' => 'legal/cookies', 'it' => 'legale/cookie', 'fr' => 'legal/cookies'],
            'controller' => [\App\Http\Controllers\LegalController::class, 'cookie'],
            'redirects' => ['/legal/cookie' => 'it'],
        ],
        'termini' => [
            'paths' => ['en' => 'legal/terms', 'it' => 'legale/termini', 'fr' => 'legal/conditions'],
            'controller' => [\App\Http\Controllers\LegalController::class, 'terms'],
            'redirects' => ['/legal/termini' => 'it'],
        ],
        'survey' => [
            'paths' => ['en' => 'ai-readiness', 'it' => 'ai-readiness', 'fr' => 'ai-readiness'],
            'controller' => [\App\Http\Controllers\SurveyController::class, 'index'],
        ],
        'survey.store' => [
            'paths' => ['en' => 'ai-readiness', 'it' => 'ai-readiness', 'fr' => 'ai-readiness'],
            'controller' => [\App\Http\Controllers\SurveyController::class, 'store'],
            'method' => 'post',
        ],
        'business-survey' => [
            'paths' => ['en' => 'business-survey', 'it' => 'business-survey', 'fr' => 'business-survey'],
            'controller' => [\App\Http\Controllers\BusinessSurveyController::class, 'index'],
            'redirects' => ['/survey' => 'it'],
        ],
        'business-survey.store' => [
            'paths' => ['en' => 'business-survey', 'it' => 'business-survey', 'fr' => 'business-survey'],
            'controller' => [\App\Http\Controllers\BusinessSurveyController::class, 'store'],
            'method' => 'post',
        ],
    ],
];
