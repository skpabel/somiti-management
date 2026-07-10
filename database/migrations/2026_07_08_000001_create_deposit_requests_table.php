<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('deposit_requests', function (Blueprint $table) {
            $table->id();

            // কোন মেম্বার রিকোয়েস্ট করেছে
            $table->unsignedBigInteger('member_id');
            $table->foreign('member_id')->references('id')->on('members')->onDelete('cascade');

            // রিকোয়েস্টের ধরন
            $table->enum('request_type', ['deposit', 'due', 'fine']);

            // কোন মাসের জন্য (যেমন 2026-07)
            $table->string('month_year', 7); // Y-m format

            // টাকার পরিমাণ
            $table->decimal('amount', 12, 2)->default(0);

            // পেমেন্ট পদ্ধতি
            $table->string('payment_method')->default('Cash');

            // ট্রানজেকশন আইডি (optional)
            $table->string('transaction_id')->nullable();

            // স্ক্রিনশট (optional)
            $table->string('screenshot')->nullable();

            // নোট (optional)
            $table->text('note')->nullable();

            // স্ট্যাটাস
            $table->enum('status', ['pending', 'approved', 'rejected'])->default('pending');

            // কোন এডমিন অ্যাকশন নিয়েছে
            $table->unsignedBigInteger('admin_id')->nullable();
            $table->foreign('admin_id')->references('id')->on('users')->onDelete('set null');

            // এডমিনের মন্তব্য
            $table->text('admin_remark')->nullable();

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('deposit_requests');
    }
};
