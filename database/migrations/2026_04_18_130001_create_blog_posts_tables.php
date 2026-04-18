<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('blog_posts', function (Blueprint $t) {
            $t->id();
            $t->string('key')->unique();
            $t->string('category')->nullable();
            $t->string('cover_path')->nullable();
            $t->timestamp('published_at')->nullable();
            $t->boolean('published')->default(false);
            $t->timestamps();
            $t->index(['published', 'published_at']);
        });

        Schema::create('blog_post_translations', function (Blueprint $t) {
            $t->id();
            $t->foreignId('blog_post_id')->constrained('blog_posts')->cascadeOnDelete();
            $t->string('locale', 5);
            $t->string('slug');
            $t->string('title');
            $t->string('excerpt', 500);
            $t->longText('body_md');
            $t->longText('body_html')->nullable();
            $t->string('meta_title')->nullable();
            $t->string('meta_description', 500)->nullable();
            $t->timestamps();
            $t->unique(['blog_post_id', 'locale']);
            $t->unique(['locale', 'slug']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('blog_post_translations');
        Schema::dropIfExists('blog_posts');
    }
};
