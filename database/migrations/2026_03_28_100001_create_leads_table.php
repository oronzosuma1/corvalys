<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('leads', function (Blueprint $t) {
            $t->id();
            $t->string('name');
            $t->string('email');
            $t->string('company')->nullable();
            $t->string('phone')->nullable();
            $t->enum('service_type', ['strategy', 'development', 'industry40', 'compliance', 'supplychain', 'llm', 'general'])->default('general');
            $t->text('project_description')->nullable();
            $t->enum('budget_range', ['under1k', '1k-5k', '5k-15k', '15k-50k', 'over50k', 'tbd'])->default('tbd');
            $t->enum('status', ['new', 'contacted', 'in_proposta', 'converted', 'lost', 'spam'])->default('new');
            $t->enum('urgency', ['esploriamo', 'importante', 'prioritario', 'urgente', 'critico'])->default('esploriamo');
            $t->text('internal_notes')->nullable();
            $t->integer('quoted_min')->nullable();
            $t->integer('quoted_max')->nullable();
            $t->string('quoted_confidence')->nullable();
            $t->json('claude_assessment')->nullable();
            $t->string('source')->nullable();
            $t->timestamp('contacted_at')->nullable();
            $t->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('leads');
    }
};
