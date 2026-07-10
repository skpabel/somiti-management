<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('expenses', function (Blueprint $table) {
            // নতুন কলাম যোগ
            $table->string('expense_month', 7)->nullable()->after('expense_date'); // ফরম্যাট: 2026-01
        });

        // পুরাতন ডাটাগুলোর জন্য অটোমেটিক মাস সেট করে দেওয়া
        DB::statement("UPDATE expenses SET expense_month = DATE_FORMAT(expense_date, '%Y-%m') WHERE expense_month IS NULL");
    }

    public function down(): void
    {
        Schema::table('expenses', function (Blueprint $table) {
            $table->dropColumn('expense_month');
        });
    }
};