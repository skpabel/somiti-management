<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('deposits', function (Blueprint $table) {
            $table->id();
            
            // Foreign Key (Member)
            $table->unsignedBigInteger('member_id');
            $table->foreign('member_id')->references('id')->on('members')->onDelete('cascade');

            // Month & Year (e.g., "2026-05")
            $table->string('month_year'); 
            
            // Deposit Info
            $table->decimal('deposit_amount', 12, 2)->default(0); // Share * 10000
            $table->decimal('due_amount', 12, 2)->default(0);     // Previous due
            $table->decimal('fine_amount', 12, 2)->default(0);    // 5% of due after 15th
            
            // Payment Info
            // আগেরটা চেঞ্জ করো:
 $table->enum('payment_method', ['Cash', 'Bkash', 'Nagad', 'Rocket', 'Bank', 'Sub Account'])->default('Cash');
            $table->string('bank_name')->nullable();      // Payment method jodi Bkash/Bank hoy
            $table->string('sub_account')->nullable();    // Payment method jodi Bkash/Bank hoy
            
            // Who made the payment entry
            $table->unsignedBigInteger('paid_by')->nullable(); // User ID
            $table->string('paid_by_info')->nullable();       // e.g., "Superadmin" or "Member Acc# 4"
            
            // Comment & Status
            $table->text('comment')->nullable();
            $table->enum('status', ['draft', 'paid'])->default('draft'); // Draft = Editable, Paid = Locked

            $table->timestamps();

            // Unique constraint: A member can have only one deposit record per month
            $table->unique(['member_id', 'month_year']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('deposits');
    }
};