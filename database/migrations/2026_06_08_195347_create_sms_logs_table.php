<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('sms_logs', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id')->nullable(); // কে SMS পাঠিয়েছেন
            $table->unsignedBigInteger('member_id')->nullable(); // কাকে পাঠানো হয়েছে (যদি সিস্টেমের মেম্বার হন)
            $table->string('acc_no')->nullable();
            $table->string('member_name')->nullable();
            $table->string('phone');
            $table->string('sms_type'); // Single, Alert, Due, Loan, Group
            $table->text('message');
            $table->string('status')->default('Pending'); // Pending, Success, Failed
            $table->string('trxn_id')->nullable(); // API থেকে আসা Transaction ID
            $table->timestamp('sent_at')->nullable();
            $table->timestamps();

            $table->foreign('user_id')->references('id')->on('users')->onDelete('set null');
            $table->foreign('member_id')->references('id')->on('members')->onDelete('set null');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('sms_logs');
    }
};