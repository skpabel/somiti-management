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
        Schema::table('notices', function (Blueprint $table) {
            $table->enum('source', ['sms_portal', 'deposit_request', 'loan_request'])
                  ->default('sms_portal')
                  ->after('target_member_ids');
        });

        // Update existing notices to have source='sms_portal'
        DB::table('notices')->whereNull('source')->update(['source' => 'sms_portal']);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('notices', function (Blueprint $table) {
            $table->dropColumn('source');
        });
    }
};
