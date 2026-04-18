<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('consent_logs', function (Blueprint $t) {
            $t->id();
            $t->string('session_id', 64)->nullable()->index();
            $t->string('ip_hash', 64)->nullable();
            $t->text('user_agent')->nullable();
            $t->json('categories_accepted');
            $t->string('policy_version', 20);
            $t->string('locale', 5)->nullable();
            $t->string('action', 20)->default('accept');
            $t->boolean('dnt')->default(false);
            $t->boolean('gpc')->default(false);
            $t->timestamps();

            $t->index(['session_id', 'created_at']);
            $t->index('policy_version');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('consent_logs');
    }
};
