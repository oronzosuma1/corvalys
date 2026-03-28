<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('consulting_requests', function (Blueprint $table) {
            $table->id();
            $table->string('company_name');
            $table->string('website_url')->nullable();
            $table->string('country')->nullable();
            $table->string('industry')->nullable();
            $table->string('company_size')->nullable();
            $table->string('contact_name');
            $table->string('contact_role')->nullable();
            $table->string('email');
            $table->string('phone')->nullable();
            $table->json('pain_points')->nullable();
            $table->text('pain_points_other')->nullable();
            $table->text('current_tools')->nullable();
            $table->json('interested_products')->nullable();
            $table->string('budget_range')->nullable();
            $table->string('desired_timeline')->nullable();
            $table->string('preferred_contact_method')->nullable();
            $table->text('success_vision')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('consulting_requests');
    }
};
