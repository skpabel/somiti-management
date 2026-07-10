<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('deposits', function (Blueprint $table) {
            $table->string('transaction_id')->nullable()->unique()->after('status'); // Auto generated
            $table->decimal('other_payment', 12, 2)->default(0)->after('fine_amount'); // Down Payment / Other
            $table->string('other_payment_reason')->nullable()->after('other_payment'); // Reason for other payment
        });
    }

    public function down(): void
    {
        Schema::table('deposits', function (Blueprint $table) {
            $table->dropColumn(['transaction_id', 'other_payment', 'other_payment_reason']);
        });
    }
};