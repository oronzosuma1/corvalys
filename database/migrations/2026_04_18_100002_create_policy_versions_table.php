<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('policy_versions', function (Blueprint $t) {
            $t->id();
            $t->string('document', 20);
            $t->string('version', 20);
            $t->string('locale', 5);
            $t->string('content_hash', 64);
            $t->timestamp('effective_from');
            $t->boolean('is_current')->default(false)->index();
            $t->timestamps();

            $t->unique(['document', 'version', 'locale']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('policy_versions');
    }
};
