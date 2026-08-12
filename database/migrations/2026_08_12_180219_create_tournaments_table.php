<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('tournaments', function (Blueprint $table) {
            $table->id();
            $table->string('name');

            $table->integer('total_matches')->default(0);
            $table->integer('completed_matches')->default(0);


            $table->foreignId('champion_team_id')->nullable()->constrained('teams')->nullOnDelete();
            $table->foreignId('runner_up_team_id')->nullable()->constrained('teams')->nullOnDelete();

            $table->boolean('is_active')->default(true);
            $table->enum('status', ['upcoming', 'running', 'completed'])->default('upcoming');

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('tournaments');
    }
};
