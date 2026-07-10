<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('loans', function (Blueprint $table) {
            // ✅ কিস্তি শুরুর তারিখ সেভ করার জন্য নতুন কলাম
            $table->date('repayment_start_date')->nullable()->after('disbursement_date');
        });
    }

    public function down(): void
    {
        Schema::table('loans', function (Blueprint $table) {
            $table->dropColumn('repayment_start_date');
        });
    }
};