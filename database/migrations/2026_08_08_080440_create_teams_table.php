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
        Schema::create('teams', function (Blueprint $table) {
            $table->id();

            // Basic Team Info
            $table->string('name');
            $table->string('logo')->nullable();

            // Owner Info
            $table->string('owner_name');
            $table->string('contact_number', 20)->nullable();
            $table->string('father_name')->nullable();
            $table->string('mother_name')->nullable();
            $table->unsignedTinyInteger('age')->nullable(); // age-এর জন্য string এর চেয়ে tinyInteger শ্রেয়
            $table->string('nationality')->default('বাংলাদেশী');

            // Location Info
            $table->string('village')->nullable();
            $table->string('post_office')->nullable(); // আগের ফর্মে পোস্ট অফিস ছিল, তাই যোগ করা হলো
            $table->string('thana')->nullable();
            $table->string('district')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('teams');
    }
};
