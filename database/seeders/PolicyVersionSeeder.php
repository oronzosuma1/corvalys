<?php

namespace Database\Seeders;

use App\Models\PolicyVersion;
use Illuminate\Database\Seeder;

class PolicyVersionSeeder extends Seeder
{
    public function run(): void
    {
        $documents = ['privacy', 'cookie', 'terms'];
        $locales = ['en', 'it', 'fr'];
        $version = '1.0.0';
        $contentHash = hash('sha256', 'placeholder-v1.0.0');
        $now = now();

        foreach ($documents as $document) {
            foreach ($locales as $locale) {
                PolicyVersion::updateOrCreate(
                    [
                        'document' => $document,
                        'version' => $version,
                        'locale' => $locale,
                    ],
                    [
                        'content_hash' => $contentHash,
                        'effective_from' => $now,
                        'is_current' => true,
                    ]
                );
            }
        }
    }
}
