<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('cookie_consents', function (Blueprint $t) {
            $t->id();
            $t->uuid('uuid')->unique()->index();
            $t->string('ip_hash', 64)->nullable();
            $t->text('user_agent')->nullable();
            $t->string('locale', 5)->nullable();
            $t->json('categories');
            $t->string('action', 20)->default('accept');
            $t->string('policy_version', 20)->index();
            $t->boolean('dnt')->default(false);
            $t->boolean('gpc')->default(false);
            $t->timestamp('created_at')->nullable();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('cookie_consents');
    }
};
