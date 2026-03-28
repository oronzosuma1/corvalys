<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('leads', function (Blueprint $t) {
            // Company profile
            $t->string('company_size')->nullable()->after('source');
            $t->string('industry')->nullable()->after('company_size');
            $t->string('country')->nullable()->after('industry');
            $t->string('website')->nullable()->after('country');

            // Technology maturity questionnaire
            $t->boolean('uses_erp')->default(false)->after('website');
            $t->string('erp_name')->nullable()->after('uses_erp');
            $t->boolean('uses_excel')->default(false)->after('erp_name');
            $t->boolean('uses_database')->default(false)->after('uses_excel');
            $t->string('database_name')->nullable()->after('uses_database');
            $t->boolean('has_it_team')->default(false)->after('database_name');
            $t->string('it_team_size')->nullable()->after('has_it_team');
            $t->boolean('uses_cloud')->default(false)->after('it_team_size');
            $t->string('cloud_provider')->nullable()->after('uses_cloud');
            $t->boolean('has_api_integrations')->default(false)->after('cloud_provider');
            $t->string('current_ai_usage')->nullable()->after('has_api_integrations');
            $t->integer('tech_maturity_score')->nullable()->after('current_ai_usage');

            // Project details
            $t->string('desired_timeline')->nullable()->after('tech_maturity_score');
            $t->text('pain_points')->nullable()->after('desired_timeline');
            $t->text('expected_outcomes')->nullable()->after('pain_points');
            $t->string('monthly_volume')->nullable()->after('expected_outcomes');

            // AI auto-assessment
            $t->json('claude_auto_assessment')->nullable()->after('monthly_volume');
            $t->timestamp('claude_auto_assessed_at')->nullable()->after('claude_auto_assessment');
        });
    }

    public function down(): void
    {
        Schema::table('leads', function (Blueprint $t) {
            $t->dropColumn([
                'company_size',
                'industry',
                'country',
                'website',
                'uses_erp',
                'erp_name',
                'uses_excel',
                'uses_database',
                'database_name',
                'has_it_team',
                'it_team_size',
                'uses_cloud',
                'cloud_provider',
                'has_api_integrations',
                'current_ai_usage',
                'tech_maturity_score',
                'desired_timeline',
                'pain_points',
                'expected_outcomes',
                'monthly_volume',
                'claude_auto_assessment',
                'claude_auto_assessed_at',
            ]);
        });
    }
};
