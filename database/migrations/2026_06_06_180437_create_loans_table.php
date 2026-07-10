<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('loans', function (Blueprint $table) {
            $table->id();
            
            $table->unsignedBigInteger('member_id');
            $table->foreign('member_id')->references('id')->on('members')->onDelete('cascade');

            // লোনের প্রাথমিক তথ্য
            $table->decimal('loan_amount', 12, 2)->default(0);
            $table->decimal('profit_amount', 12, 2)->default(0); // ম্যানুয়াল প্রফিট
            $table->decimal('total_payable', 12, 2)->default(0); // মোট পরিশোধযোগ্য
            $table->string('purpose')->nullable(); // লোনের কারণ
            
            // কিস্তি প্ল্যান
            $table->enum('repayment_type', ['one_time', 'monthly', '2_months', '3_months', '5_months', '6_months'])->default('monthly');
            $table->decimal('installment_amount', 12, 2)->default(0);
            
            // ৮০% এর বেশি এবং ডিউ/ফাইন ওয়ার্নিং
            $table->text('reason_for_over_80')->nullable();
            $table->boolean('had_due_fine_warning')->default(false); // আবেদনের সময় ডিউ ছিল কিনা

            // স্ট্যাটাস এবং অ্যাপ্রুভাল
            $table->enum('status', ['pending', 'approved', 'disbursed', 'active', 'repaid', 'rejected'])->default('pending');
            $table->unsignedBigInteger('applied_by')->nullable(); // কে ফর্ম ফিলআপ করেছে
            $table->unsignedBigInteger('approved_by')->nullable(); // কে অ্যাপ্রুভ করেছে
            $table->text('rejection_reason')->nullable();

            // ডিজবার্সমেন্ট (টাকা প্রদান) তথ্য
            $table->string('disbursement_method')->nullable(); // Bank, Cash, Mobile, Sub Account, Mix
            $table->json('disbursement_details')->nullable(); // Cheque No, Trans ID, Photo Path, Description
            $table->date('disbursement_date')->nullable();

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('loans');
    }
};