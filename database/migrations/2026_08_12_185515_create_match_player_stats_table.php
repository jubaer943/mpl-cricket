<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('match_player_stats', function (Blueprint $table) {
            $table->id();
            $table->foreignId('fixture_id')->constrained()->cascadeOnDelete();
            $table->foreignId('player_id')->constrained()->cascadeOnDelete();
            $table->foreignId('team_id')->constrained()->cascadeOnDelete();


            $table->integer('runs_scored')->default(0);
            $table->integer('balls_faced')->default(0);
            $table->integer('fours')->default(0);
            $table->integer('sixes')->default(0);
            $table->string('out_type')->nullable(); // bowled, caught, run_out, not_out

            $table->decimal('overs_bowled', 3, 1)->default(0.0);
            $table->integer('runs_conceded')->default(0);
            $table->integer('wickets_taken')->default(0);
            $table->integer('maiden_overs')->default(0);


            $table->integer('catches')->default(0);
            $table->integer('stumpings')->default(0);

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('match_player_stats');
    }
};
