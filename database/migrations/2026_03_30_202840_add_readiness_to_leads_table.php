<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('leads', function (Blueprint $table) {
            // AI Readiness quick assessment (1 key criterion per dimension, scored 1-5)
            // JSON: { "leadership": 3, "data": 2, "technology": 4, "culture": 2, "process": 3, "compliance": 1 }
            $table->json('readiness_scores')->nullable()->after('tech_maturity_score');
            // Low-score reasons for dimensions scored 1-2
            // JSON: { "leadership": "No AI vision yet", "compliance": "Never heard of AI Act" }
            $table->json('readiness_reasons')->nullable()->after('readiness_scores');
            // Computed overall readiness score (avg of 6 dimensions, 1.0-5.0)
            $table->decimal('readiness_overall', 3, 1)->nullable()->after('readiness_reasons');
        });
    }

    public function down(): void
    {
        Schema::table('leads', function (Blueprint $table) {
            $table->dropColumn(['readiness_scores', 'readiness_reasons', 'readiness_overall']);
        });
    }
};
