<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('services', function (Blueprint $t) {
            $t->id();
            $t->enum('type', ['prodotto', 'consulenza']);
            $t->string('name');
            $t->string('slug')->unique();
            $t->text('short_description');
            $t->longText('description')->nullable();
            $t->decimal('price_from', 10, 2)->nullable();
            $t->decimal('price_to', 10, 2)->nullable();
            $t->string('price_unit')->nullable(); // ora, mese, progetto
            $t->boolean('is_active')->default(true);
            $t->integer('sort_order')->default(0);
            $t->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('services');
    }
};
