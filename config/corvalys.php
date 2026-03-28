<?php

return [
    'enzo_email' => env('ENZO_EMAIL', 'enzo@corvalys.eu'),
    'calendly_url' => env('CALENDLY_URL'),
    'tariffe' => [
        'strategy' => ['min' => 150, 'max' => 250],
        'development' => ['min' => 120, 'max' => 200],
        'industry40' => ['min' => 100, 'max' => 180],
        'compliance' => ['min' => 120, 'max' => 200],
        'supplychain' => ['min' => 140, 'max' => 220],
        'llm' => ['min' => 110, 'max' => 180],
    ],
    'prezzi' => [
        'starter' => ['monthly' => 0, 'annual' => 0, 'trial_months' => 3],
        'core' => ['monthly' => 49, 'annual' => 470],
        'pro' => ['monthly' => 89, 'annual' => 855],
        'business' => ['monthly' => 179, 'annual' => null],
    ],
];
