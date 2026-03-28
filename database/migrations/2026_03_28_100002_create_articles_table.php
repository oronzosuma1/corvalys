<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('articles', function (Blueprint $t) {
            $t->id();
            $t->string('title');
            $t->string('slug')->unique();
            $t->text('excerpt');
            $t->longText('body');
            $t->enum('category', ['ai-pmi', 'ai-act', 'supply-chain', 'prodotto', 'case-study'])->default('ai-pmi');
            $t->json('tags')->nullable();
            $t->string('cover_image')->nullable();
            $t->integer('reading_time_min')->default(5);
            $t->boolean('is_published')->default(false);
            $t->timestamp('published_at')->nullable();
            $t->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('articles');
    }
};
