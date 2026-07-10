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
                Schema::create('members', function (Blueprint $table) {
            $table->id();
            
            // Personal Information
            $table->string('account_no')->unique(); // Account / Serial No
            $table->string('name_english');
            $table->string('name_bangla')->nullable();
            $table->date('dob')->nullable(); // Date of Birth
            $table->string('mobile')->unique(); // Mobile Number
            $table->enum('gender', ['Male', 'Female', 'Other'])->default('Male');
            $table->string('nid')->nullable(); // NID Number
            $table->decimal('shares', 8, 2)->default(0.5); // Number of Shares
            $table->string('photo')->nullable(); // Upload Photo path
            
            // Registration Details
            $table->decimal('registration_fee', 8, 2)->default(0.00);
            $table->date('registration_date');
            
            // Address Information
            $table->text('present_address')->nullable();
            $table->text('permanent_address')->nullable();
            
            // Nominee Information
            $table->string('nominee_name')->nullable();
            $table->string('nominee_relation')->nullable();
            $table->string('nominee_mobile')->nullable();
            
            // User Login Link (Optional: if member is also a user)
            $table->unsignedBigInteger('user_id')->nullable(); 

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('members');
    }
};
