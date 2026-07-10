<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('loans', function (Blueprint $table) {
            // ✅ লোন এডিটের অডিট হিস্ট্রি সেভ করার জন্য নতুন কলাম
            $table->json('edit_history')->nullable()->after('disbursement_details');
        });
    }

    public function down(): void
    {
        Schema::table('loans', function (Blueprint $table) {
            $table->dropColumn('edit_history');
        });
    }
};