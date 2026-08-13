<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Fixture extends Model
{
    protected $guarded = [];

    protected $casts = [
        'match_number' => 'integer',
    ];

    /**
     * ম্যাচটি যে টুর্নামেন্টের অধীনে
     */
    public function tournament(): BelongsTo
    {
        return $this->belongsTo(Tournament::class);
    }

    /**
     * প্রথম টিম (Team A)
     */
    public function teamOne(): BelongsTo
    {
        return $this->belongsTo(Team::class, 'team_one_id');
    }

    /**
     * দ্বিতীয় টিম (Team B)
     */
    public function teamTwo(): BelongsTo
    {
        return $this->belongsTo(Team::class, 'team_two_id');
    }

    /**
     * টস বিজয়ী দল
     */
    public function tossWinner(): BelongsTo
    {
        return $this->belongsTo(Team::class, 'toss_winner_team_id');
    }

    /**
     * বিজয়ী টিম
     */
    public function winner(): BelongsTo
    {
        return $this->belongsTo(Team::class, 'winner_team_id');
    }

    /**
     * ম্যান অফ দ্য ম্যাচ প্লেয়ার
     */
    public function manOfTheMatch(): BelongsTo
    {
        return $this->belongsTo(Player::class, 'man_of_the_match_id');
    }

    /**
     * এই ম্যাচের প্লেয়ারদের ইন্ডিভিজুয়াল স্কোরকার্ড/পারফরম্যান্স
     */
    // public function playerStats(): HasMany
    // {
    //     return $this->hasMany(MatchPlayerStat::class);
    // }
}
