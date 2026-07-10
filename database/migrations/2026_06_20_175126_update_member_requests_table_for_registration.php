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
        Schema::table('member_requests', function (Blueprint $table) {
            // ১. আগের Foreign Key টা ডিলিট করা হচ্ছে
            $table->dropForeign(['member_id']);

            // ২. member_id কে Nullable করা হচ্ছে
            $table->unsignedBigInteger('member_id')->nullable()->change();

            // ৩. আবার Foreign Key টা ফিরিয়ে আনা হচ্ছে (এখন এটি null হলেও কোনো সমস্যা নেই)
            $table->foreign('member_id')->references('id')->on('members')->onDelete('cascade');

            // ৪. type কলামে নতুন অপশন যোগ করা
            $table->dropColumn('type');
            $table->enum('type', ['loan_unlock', 'profile_edit', 'new_registration'])->after('member_id');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('member_requests', function (Blueprint $table) {
            $table->dropForeign(['member_id']);
            $table->unsignedBigInteger('member_id')->nullable(false)->change();
            $table->foreign('member_id')->references('id')->on('members')->onDelete('cascade');
            
            $table->dropColumn('type');
            $table->enum('type', ['loan_unlock', 'profile_edit'])->after('member_id');
        });
    }
};
