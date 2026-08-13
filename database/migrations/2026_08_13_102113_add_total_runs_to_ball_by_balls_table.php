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
        Schema::table('ball_by_balls', function (Blueprint $table) {
            $table->integer('total_runs')->default(0)->after('extra_runs');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('ball_by_balls', function (Blueprint $table) {
            $table->dropColumn('total_runs');
        });
    }
};
