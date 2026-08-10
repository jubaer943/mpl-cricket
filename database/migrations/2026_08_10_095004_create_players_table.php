<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('players', function (Blueprint $table) {
            $table->id();

            // Personal & Photo
            $table->string('photo');
            $table->string('name');
            $table->string('father_name');
            $table->string('mother_name');
            $table->string('phone');
            $table->date('date_of_birth');
            $table->string('nationality')->default('বাংলাদেশী');

            // Address
            $table->string('village');
            $table->string('post_office');
            $table->string('thana');
            $table->string('district');
            $table->text('other_address')->nullable(); // অন্যান্য (বসবাসরত ঠিকানা)

            // Cricket Info
            $table->string('batting_style');
            $table->string('player_role');
            $table->string('bowling_style')->nullable();
            $table->string('jersey_size');
            $table->string('past_team')->nullable();

            // Grade & Category System
            $table->foreignId('category_id')->nullable()->constrained('categories')->nullOnDelete();
            $table->string('grade'); // Grade A, B, C
            $table->decimal('base_price', 10, 2)->default(0);
            $table->foreignId('team_id')->nullable()->constrained('teams')->nullOnDelete();
            $table->decimal('sold_price', 10, 2)->default(0);
            $table->enum('auction_status', ['available', 'bidding', 'sold', 'unsold'])->default('available');

            // Payment Proof & Approval
            $table->string('payment_method');
            $table->string('sender_number');
            $table->string('transaction_id')->unique();
            $table->enum('status', ['pending', 'approved', 'rejected'])->default('pending');

            // Note
            $table->text('note')->nullable();

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('players');
    }
};
