<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('loan_repayments', function (Blueprint $table) {
            $table->id();
            
            $table->unsignedBigInteger('loan_id');
            $table->foreign('loan_id')->references('id')->on('loans')->onDelete('cascade');

            $table->decimal('amount', 12, 2); // কিস্তির পরিমাণ
            $table->string('payment_method')->default('Cash'); // Cash, Bank, Sub Account etc.
            $table->json('transaction_details')->nullable(); // Trans ID, Screenshot Path
            
            $table->unsignedBigInteger('paid_by')->nullable(); // কে কালেকশন করলো
            $table->date('payment_date');
            
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('loan_repayments');
    }
};