<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('ball_by_balls', function (Blueprint $table) {
            $table->id();
            $table->foreignId('fixture_id')->constrained()->cascadeOnDelete();

            // ইনিংস সংক্রান্ত
            $table->integer('innings_number')->default(1); // 1st Innings or 2nd Innings
            $table->integer('over_number'); // e.g. 1, 2, 3... 20
            $table->integer('ball_number'); // e.g. 1 to 6 (ডিফল্ট বল)

            // কে বল করলো এবং কে ফেস করলো
            $table->foreignId('bowler_id')->constrained('players')->cascadeOnDelete();
            $table->foreignId('batsman_id')->constrained('players')->cascadeOnDelete();
            $table->foreignId('non_striker_id')->nullable()->constrained('players')->nullOnDelete();

            // রানের বিবরণ
            $table->integer('batsman_runs')->default(0); // ০, ১, ২, ৩, ৪, ৬ (ব্যাটার পাবে)
            $table->integer('extra_runs')->default(0); // Wide/No Ball এর ১ রান বা বাই/লেগ-বাই এর রান
            $table->string('extra_type')->nullable(); // wide, no_ball, bye, leg_bye, penalty

            // উইকেটের বিবরণ
            $table->boolean('is_wicket')->default(false);
            $table->string('wicket_type')->nullable(); // bowled, caught, run_out, lbw, stumped
            $table->foreignId('dismissed_player_id')->nullable()->constrained('players')->nullOnDelete();
            $table->foreignId('assisted_by_player_id')->nullable()->constrained('players')->nullOnDelete(); // ফিল্ডার/ক্যাচার

            // মন্তব্য বা ধারাভাষ্য
            $table->string('commentary')->nullable(); // e.g. "FOUR! Beautiful cover drive!"

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('ball_by_balls');
    }
};
