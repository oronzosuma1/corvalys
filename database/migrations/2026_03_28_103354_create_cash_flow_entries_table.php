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
        Schema::create('cash_flow_entries', function (Blueprint $t) {
            $t->id();
            $t->enum('type', ['entrata', 'uscita']);
            $t->string('category');
            $t->string('description');
            $t->decimal('amount', 10, 2);
            $t->date('date');
            $t->boolean('is_recurring')->default(false);
            $t->string('recurring_frequency')->nullable();
            $t->foreignId('invoice_id')->nullable()->constrained()->nullOnDelete();
            $t->text('notes')->nullable();
            $t->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('cash_flow_entries');
    }
};
