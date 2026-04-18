<?php

return [
    /*
    |--------------------------------------------------------------------------
    | Policy Version
    |--------------------------------------------------------------------------
    | Increment this whenever Privacy Policy, Cookie Policy, or Terms change.
    | Any change invalidates stored consents and forces users to re-consent.
    */
    'policy_version' => env('LEGAL_POLICY_VERSION', '2026-04'),

    /*
    | Consent expiration in months — ePrivacy recommends max 6 months.
    */
    'consent_expires_months' => 6,

    /*
    | IP truncation before hashing (GDPR data minimization):
    | - ipv4: /24 (remove last octet)
    | - ipv6: /64 (keep first 4 segments)
    */
    'truncate_ip' => true,
];
