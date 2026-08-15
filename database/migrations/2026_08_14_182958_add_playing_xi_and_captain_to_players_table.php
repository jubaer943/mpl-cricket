<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('players', function (Blueprint $table) {
            $table->boolean('is_playing_xi')
                ->default(false)
                ->after('team_id');

            $table->boolean('is_captain')
                ->default(false)
                ->after('is_playing_xi');
        });
    }

    public function down(): void
    {
        Schema::table('players', function (Blueprint $table) {
            $table->dropColumn([
                'is_playing_xi',
                'is_captain',
            ]);
        });
    }
};
