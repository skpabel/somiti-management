<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('users', function (Blueprint $table) {
            // ✅ চেক করে দেখছি role কলাম আগে থেকে আছে কিনা
            if (!Schema::hasColumn('users', 'role')) {
                $table->string('role')->default('user')->after('password');
            }
            
            // ✅ চেক করে দেখছি permissions কলাম আগে থেকে আছে কিনা
            if (!Schema::hasColumn('users', 'permissions')) {
                $table->json('permissions')->nullable()->after('role');
            }
        });

        // ✅ আগে থেকে থাকা ডিফল্ট Admin ইউজারকে Super Admin বানানো হচ্ছে
        DB::table('users')->where('username', 'admin')->update([
            'role' => 'super_admin',
            'permissions' => null // Super Admin-এর permissions লাগবে না, তার Full Access
        ]);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            // ড্রপ করার আগেও চেক করে নিচ্ছি
            if (Schema::hasColumn('users', 'role')) {
                $table->dropColumn('role');
            }
            if (Schema::hasColumn('users', 'permissions')) {
                $table->dropColumn('permissions');
            }
        });
    }
};