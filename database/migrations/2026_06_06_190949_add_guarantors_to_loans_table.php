<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('loans', function (Blueprint $table) {
            // জামিনদার ১ এবং ২ এর ফরেন কি (মেম্বার টেবিলের সাথে রিলেশন)
            $table->unsignedBigInteger('guarantor_1_id')->nullable()->after('member_id');
            $table->foreign('guarantor_1_id')->references('id')->on('members')->onDelete('set null');

            $table->unsignedBigInteger('guarantor_2_id')->nullable()->after('guarantor_1_id');
            $table->foreign('guarantor_2_id')->references('id')->on('members')->onDelete('set null');

            // অ্যাডমিন ওভাররাইড ফ্ল্যাগ (যদি অ্যাডমিন জোর করে জামিনদার সেট করে)
            $table->boolean('guarantor_1_override')->default(false)->after('guarantor_2_id');
            $table->boolean('guarantor_2_override')->default(false)->after('guarantor_1_override');
        });
    }

    public function down(): void
    {
        Schema::table('loans', function (Blueprint $table) {
            $table->dropForeign(['guarantor_1_id']);
            $table->dropForeign(['guarantor_2_id']);
            
            $table->dropColumn([
                'guarantor_1_id', 
                'guarantor_2_id', 
                'guarantor_1_override', 
                'guarantor_2_override'
            ]);
        });
    }
};