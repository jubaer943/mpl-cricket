<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::table('fixtures', function (Blueprint $table) {
            // ডাটা সেভ রেখে নতুন ফিল্ড যোগ
            // $table->integer('total_overs')->default(20)->after('team_two_id'); // e.g. 20, 10
            $table->integer('current_innings')->default(1)->after('total_overs'); // 1st or 2nd
            $table->integer('target_runs')->nullable()->after('toss_decision'); // ১ম ইনিংস শেষে সেট হবে
        });
    }

    public function down(): void
    {
        Schema::table('fixtures', function (Blueprint $table) {
            $table->dropColumn(['total_overs', 'current_innings', 'target_runs']);
        });
    }
};
