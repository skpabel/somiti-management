<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        // Members Table
        Schema::table('members', function (Blueprint $table) {
            $table->dateTime('registration_date')->change();
        });

        // Expenses Table
        Schema::table('expenses', function (Blueprint $table) {
            $table->dateTime('expense_date')->change();
        });

        // Loans Table
        Schema::table('loans', function (Blueprint $table) {
            $table->dateTime('disbursement_date')->nullable()->change();
        });

        // Loan Repayments Table
        Schema::table('loan_repayments', function (Blueprint $table) {
            $table->dateTime('payment_date')->change();
        });
    }

    public function down(): void
    {
        Schema::table('members', function (Blueprint $table) {
            $table->date('registration_date')->change();
        });

        Schema::table('expenses', function (Blueprint $table) {
            $table->date('expense_date')->change();
        });

        Schema::table('loans', function (Blueprint $table) {
            $table->date('disbursement_date')->nullable()->change();
        });

        Schema::table('loan_repayments', function (Blueprint $table) {
            $table->date('payment_date')->change();
        });
    }
};