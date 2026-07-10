<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        // ✅ Deposits table এর payment_method কে VARCHAR তে পরিবর্তন
        DB::statement("ALTER TABLE deposits MODIFY COLUMN payment_method VARCHAR(50) DEFAULT 'Cash'");
        
        // ✅ Expenses table এর payment_method কে VARCHAR তে পরিবর্তন
        DB::statement("ALTER TABLE expenses MODIFY COLUMN payment_method VARCHAR(50) DEFAULT 'Cash'");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // রিভার্স করার দরকার নেই, তবুও রাখা হলো
        DB::statement("ALTER TABLE deposits MODIFY COLUMN payment_method ENUM('Cash', 'Bkash', 'Nagad', 'Rocket', 'Bank') DEFAULT 'Cash'");
        DB::statement("ALTER TABLE expenses MODIFY COLUMN payment_method ENUM('Cash', 'Bkash', 'Nagad', 'Rocket', 'Bank') DEFAULT 'Cash'");
    }
};