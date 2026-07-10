<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('activity_logs', function (Blueprint $table) {
            $table->id();
            
            // কে এই অ্যাকশনটি করেছেন
            $table->unsignedBigInteger('user_id')->nullable();
            $table->foreign('user_id')->references('id')->on('users')->onDelete('set null');

            // লগের ধরন (Deposit, Expense, Transfer, Refund)
            $table->string('log_type'); 
            
            // স্পেসিফিক অ্যাকশন (Paid, Created, Transferred, Refunded)
            $table->string('action'); 

            // বিস্তারিত বিবরণ (যেমন: "Cash থেকে Bkash এ ৫০০০ টাকা ট্রান্সফার করা হয়েছে")
            $table->text('description');

            // অতিরিক্ত ডাটা জেসন আকারে (যেমন: আগের মেথড, নতুন মেথড, টাকার পরিমাণ)
            $table->json('properties')->nullable(); 

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('activity_logs');
    }
};