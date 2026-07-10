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
        Schema::create('otps', function (Blueprint $table) {
            $table->id();
            $table->string('identifier'); // Mobile Number or Email Address
            $table->string('otp'); // 4 or 6 digit OTP
            $table->enum('type', ['registration', 'password_reset'])->default('password_reset');
            $table->boolean('is_verified')->default(false);
            $table->timestamp('expires_at'); // OTP কখন এক্সপায়ার হবে
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('otps');
    }
};
