<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('partner_requests', function (Blueprint $t) {
            $t->id();
            $t->string('name');
            $t->string('email');
            $t->string('studio_name');
            $t->integer('clients_count')->nullable();
            $t->text('message')->nullable();
            $t->enum('status', ['new', 'approved', 'rejected'])->default('new');
            $t->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('partner_requests');
    }
};
