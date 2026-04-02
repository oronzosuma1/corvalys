<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('survey_responses', function (Blueprint $table) {
            $table->id();

            // Company info
            $table->string('company_name');
            $table->string('company_size'); // 1-9, 10-49, 50-249, 250+
            $table->string('industry');
            $table->string('country')->nullable();
            $table->string('contact_name');
            $table->string('contact_email');
            $table->string('contact_role')->nullable();
            $table->string('contact_phone')->nullable();

            // Scores per dimension (JSON: {"L1": 3, "L2": 4, ...})
            $table->json('scores_leadership')->nullable();
            $table->json('scores_data')->nullable();
            $table->json('scores_technology')->nullable();
            $table->json('scores_culture')->nullable();
            $table->json('scores_process')->nullable();
            $table->json('scores_compliance')->nullable();

            // Notes/evidence per criterion (JSON: {"L1": "evidence...", ...})
            $table->json('notes_leadership')->nullable();
            $table->json('notes_data')->nullable();
            $table->json('notes_technology')->nullable();
            $table->json('notes_culture')->nullable();
            $table->json('notes_process')->nullable();
            $table->json('notes_compliance')->nullable();

            // Low-score reasons (JSON: {"L1": "reason...", ...}) for scores <= 2
            $table->json('low_reasons_leadership')->nullable();
            $table->json('low_reasons_data')->nullable();
            $table->json('low_reasons_technology')->nullable();
            $table->json('low_reasons_culture')->nullable();
            $table->json('low_reasons_process')->nullable();
            $table->json('low_reasons_compliance')->nullable();

            // Computed dimension averages
            $table->decimal('avg_leadership', 3, 1)->nullable();
            $table->decimal('avg_data', 3, 1)->nullable();
            $table->decimal('avg_technology', 3, 1)->nullable();
            $table->decimal('avg_culture', 3, 1)->nullable();
            $table->decimal('avg_process', 3, 1)->nullable();
            $table->decimal('avg_compliance', 3, 1)->nullable();
            $table->decimal('overall_score', 3, 1)->nullable();

            // Additional context
            $table->text('additional_comments')->nullable();
            $table->boolean('wants_consultation')->default(false);
            $table->string('preferred_language', 5)->default('en');

            $table->timestamp('completed_at')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('survey_responses');
    }
};
