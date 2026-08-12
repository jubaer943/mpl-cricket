<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Tournament extends Model
{
    protected $guarded = [];

    protected $casts = [
        'total_matches' => 'integer',
        'completed_matches' => 'integer',
        'is_active' => 'boolean',
        'is_auction_live' => 'boolean',
    ];

    /**
     * এই টুর্নামেন্টে অংশগ্রহণকারী সব টিম (Pivot Table: tournament_team)
     */
    public function teams(): BelongsToMany
    {
        return $this->belongsToMany(Team::class, 'tournament_team')
            ->withPivot('group_name', 'points')
            ->withTimestamps();
    }

    /**
     * এই টুর্নামেন্টের সব ফিক্সচার / ম্যাচ
     */
    // public function fixtures(): HasMany
    // {
    //     return $this->hasMany(Fixture::class);
    // }

    /**
     * চ্যাম্পিয়ন টিম রিলেশন
     */
    public function champion(): BelongsTo
    {
        return $this->belongsTo(Team::class, 'champion_team_id');
    }

    /**
     * রানার আপ টিম রিলেশন
     */
    public function runnerUp(): BelongsTo
    {
        return $this->belongsTo(Team::class, 'runner_up_team_id');
    }
}
