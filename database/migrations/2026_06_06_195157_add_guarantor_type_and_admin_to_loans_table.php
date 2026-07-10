<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('loans', function (Blueprint $table) {
            // জামিনদারের ধরন (member নাকি admin)
            $table->string('guarantor_type')->default('member')->after('member_id');
            
            // এডমিন জামিনদার হলে তার User ID সেভ করার জন্য
            $table->unsignedBigInteger('admin_guarantor_id')->nullable()->after('guarantor_2_override');
            $table->foreign('admin_guarantor_id')->references('id')->on('users')->onDelete('set null');
        });
    }

    public function down(): void
    {
        Schema::table('loans', function (Blueprint $table) {
            $table->dropForeign(['admin_guarantor_id']);
            $table->dropColumn(['guarantor_type', 'admin_guarantor_id']);
        });
    }
};