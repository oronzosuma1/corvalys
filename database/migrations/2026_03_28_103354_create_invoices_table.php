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
        Schema::create('invoices', function (Blueprint $t) {
            $t->id();
            $t->string('invoice_number')->unique();
            $t->enum('type', ['emessa', 'ricevuta']);
            $t->string('client_name');
            $t->string('client_email')->nullable();
            $t->string('client_vat')->nullable();
            $t->decimal('amount', 10, 2);
            $t->decimal('vat_amount', 10, 2)->default(0);
            $t->decimal('total', 10, 2);
            $t->string('currency', 3)->default('EUR');
            $t->enum('status', ['bozza', 'inviata', 'pagata', 'scaduta', 'annullata'])->default('bozza');
            $t->date('issue_date');
            $t->date('due_date');
            $t->date('paid_date')->nullable();
            $t->text('description')->nullable();
            $t->text('notes')->nullable();
            $t->foreignId('lead_id')->nullable()->constrained()->nullOnDelete();
            $t->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('invoices');
    }
};
