<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('business_surveys', function (Blueprint $table) {
            $table->id();

            // Company profile
            $table->string('company_size', 30)->nullable();
            $table->string('sector', 50)->nullable();
            $table->string('country', 100)->nullable();
            $table->string('respondent_role', 50)->nullable();

            // Pain areas
            $table->json('frustration_areas')->nullable();
            $table->string('main_pain_driver', 100)->nullable();
            $table->string('pain_frequency', 30)->nullable();
            $table->string('time_wasted_weekly', 30)->nullable();
            $table->unsignedTinyInteger('pain_severity')->nullable();

            // Repetitive tasks
            $table->json('repetitive_tasks')->nullable();
            $table->json('top_delegate_tasks')->nullable();
            $table->string('preferred_outcome', 100)->nullable();

            // AI readiness
            $table->string('current_ai_usage', 30)->nullable();
            $table->json('ai_concerns')->nullable();
            $table->string('readiness_statement', 50)->nullable();

            // Product interest
            $table->json('preferred_ai_areas')->nullable();
            $table->string('preferred_support_model', 50)->nullable();
            $table->string('preferred_start_method', 50)->nullable();
            $table->json('trust_factors')->nullable();

            // Computed scores (1-10)
            $table->unsignedTinyInteger('pain_score')->nullable();
            $table->unsignedTinyInteger('automation_potential')->nullable();
            $table->unsignedTinyInteger('commercial_readiness')->nullable();
            $table->json('opportunity_clusters')->nullable();

            // Optional contact
            $table->string('contact_name', 100)->nullable();
            $table->string('contact_company', 100)->nullable();
            $table->string('contact_email', 255)->nullable();
            $table->string('contact_phone', 30)->nullable();
            $table->string('contact_country', 100)->nullable();
            $table->boolean('wants_insights')->default(false);
            $table->boolean('wants_solutions_contact')->default(false);
            $table->boolean('wants_pilot')->default(false);
            $table->boolean('gdpr_consent')->default(false);
            $table->boolean('is_lead')->default(false);

            // Tracking
            $table->string('session_id', 64)->nullable()->index();
            $table->string('preferred_language', 5)->nullable();
            $table->timestamp('completed_at')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('business_surveys');
    }
};
