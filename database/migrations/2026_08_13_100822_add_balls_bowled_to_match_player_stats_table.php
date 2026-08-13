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
        Schema::table('match_player_stats', function (Blueprint $table) {
            // ডাটা না হারিয়ে নতুন কলামটি যোগ করা হচ্ছে
            $table->integer('balls_bowled')->default(0)->after('overs_bowled');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('match_player_stats', function (Blueprint $table) {
            $table->dropColumn('balls_bowled');
        });
    }
};
