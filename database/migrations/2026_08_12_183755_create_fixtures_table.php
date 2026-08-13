<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('fixtures', function (Blueprint $table) {
            $table->id();
            $table->foreignId('tournament_id')->constrained()->cascadeOnDelete();


            $table->foreignId('team_one_id')->constrained('teams')->cascadeOnDelete();
            $table->foreignId('team_two_id')->constrained('teams')->cascadeOnDelete();

            $table->string('team_one_score')->nullable();
            $table->string('team_one_overs')->nullable();
            $table->string('team_two_score')->nullable();
            $table->string('team_two_overs')->nullable();

            $table->foreignId('toss_winner_team_id')->nullable()->constrained('teams')->nullOnDelete();
            $table->string('toss_decision')->nullable();
            $table->foreignId('winner_team_id')->nullable()->constrained('teams')->nullOnDelete();
            $table->string('result_description')->nullable();
            $table->foreignId('man_of_the_match_id')->nullable()->constrained('players')->nullOnDelete();

            $table->integer('match_number')->nullable();
            $table->string('match_type')->default('group');
            $table->enum('status', ['upcoming', 'live', 'completed'])->default('upcoming');

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('fixtures');
    }
};
