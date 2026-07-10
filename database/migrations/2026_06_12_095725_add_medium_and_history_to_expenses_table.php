<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('expenses', function (Blueprint $table) {
            // মাধ্যম (Direct নাকি Member এর মাধ্যমে)
            $table->string('medium_type')->default('Direct')->after('bank_name'); // Direct / Member
            $table->unsignedBigInteger('member_id')->nullable()->after('medium_type'); // যদি Member হয়
            
            // Edit History সেভ করার জন্য JSON কলাম
            $table->json('edit_history')->nullable()->after('created_by');

            $table->foreign('member_id')->references('id')->on('members')->onDelete('set null');
        });
    }

    public function down(): void
    {
        Schema::table('expenses', function (Blueprint $table) {
            $table->dropForeign(['member_id']);
            $table->dropColumn(['medium_type', 'member_id', 'edit_history']);
        });
    }
};