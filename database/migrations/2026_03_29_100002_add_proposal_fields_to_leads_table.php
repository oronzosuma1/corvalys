<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('leads', function (Blueprint $table) {
            $table->string('proposal_pdf_path')->nullable()->after('claude_auto_assessed_at');
            $table->string('proposal_status')->nullable()->default(null)->after('proposal_pdf_path');
            $table->timestamp('proposal_sent_at')->nullable()->after('proposal_status');
            $table->timestamp('proposal_approved_at')->nullable()->after('proposal_sent_at');
            $table->string('proposal_language', 5)->nullable()->default('en')->after('proposal_approved_at');
        });
    }

    public function down(): void
    {
        Schema::table('leads', function (Blueprint $table) {
            $table->dropColumn([
                'proposal_pdf_path',
                'proposal_status',
                'proposal_sent_at',
                'proposal_approved_at',
                'proposal_language',
            ]);
        });
    }
};
