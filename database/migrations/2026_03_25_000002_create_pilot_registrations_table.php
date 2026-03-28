<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('pilot_registrations', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('email');
            $table->string('company')->nullable();
            $table->string('country')->nullable();
            $table->string('product_interest')->nullable();
            $table->text('message')->nullable();
            $table->string('source')->default('product_page'); // product_page, landing, etc.
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('pilot_registrations');
    }
};
