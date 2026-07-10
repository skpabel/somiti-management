<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('member_requests', function (Blueprint $table) {
            $table->id();
            
            // কোন মেম্বার রিকোয়েস্ট করেছে
            $table->unsignedBigInteger('member_id');
            $table->foreign('member_id')->references('id')->on('members')->onDelete('cascade');

            // রিকোয়েস্টের ধরন (loan_unlock অথবা profile_edit)
            $table->enum('type', ['loan_unlock', 'profile_edit']);

            // রিকোয়েস্টের স্ট্যাটাস
            $table->enum('status', ['pending', 'approved', 'rejected'])->default('pending');

            // প্রোফাইল এডিট রিকোয়েস্ট হলে কোন ফিল্ড এবং কী ভ্যালু চেঞ্জ করতে চায় তার ডাটা (JSON)
            $table->json('data')->nullable();

            // কোন এডমিন এপ্রুভ বা রিজেক্ট করেছে
            $table->unsignedBigInteger('admin_id')->nullable();
            $table->foreign('admin_id')->references('id')->on('users')->onDelete('set null');

            // এডমিনের মন্তব্য (যদি থাকে)
            $table->text('admin_remark')->nullable();

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('member_requests');
    }
};