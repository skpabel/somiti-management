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
        Schema::create('expenses', function (Blueprint $table) {
            $table->id();
            
            // খরচের তথ্য
            $table->date('expense_date'); 
            $table->string('category'); // যেমন: Electricity, Tea, Rent
            $table->string('description')->nullable(); // বিস্তারিত
            $table->decimal('amount', 12, 2); // খরচের পরিমাণ
            
            // পেমেন্ট মেথড (Deposit এর সাথে মিলিয়ে দেওয়া হয়েছে)
            $table->enum('payment_method', ['Cash', 'Bkash', 'Nagad', 'Rocket', 'Bank', 'Sub Account'])->default('Cash');
            $table->string('bank_name')->nullable(); 
            $table->string('sub_account')->nullable(); 
            
            // কে এন্ট্রি করেছেন
            $table->unsignedBigInteger('created_by')->nullable();
            $table->foreign('created_by')->references('id')->on('users')->onDelete('set null');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('expenses');
    }
};
