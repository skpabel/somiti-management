<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('sms_templates', function (Blueprint $table) {
            $table->id();
            $table->string('name'); // টেমপ্লেটের নাম
            $table->string('category'); // Single SMS, Alert SMS, Due SMS, Loan SMS, Group SMS
            $table->text('message'); // মেসেজের বডি
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('sms_templates');
    }
};