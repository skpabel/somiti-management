<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('loans', function (Blueprint $table) {
            // ✅ আবেদনের সময় জামানত চেক (Security Cheque)
            $table->string('security_cheque')->nullable()->after('disbursement_date');
            
            // ✅ অ্যাপ্রুভের সময় দেওয়া চেক (Approve Cheque)
            $table->string('approve_cheque')->nullable()->after('security_cheque');
        });
    }

    public function down(): void
    {
        Schema::table('loans', function (Blueprint $table) {
            $table->dropColumn(['security_cheque', 'approve_cheque']);
        });
    }
};