<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('notice_reads', function (Blueprint $table) {
            $table->timestamp('deleted_at')->nullable()->after('read_at');
        });
    }

    public function down(): void
    {
        Schema::table('notice_reads', function (Blueprint $table) {
            $table->dropColumn('deleted_at');
        });
    }
};
