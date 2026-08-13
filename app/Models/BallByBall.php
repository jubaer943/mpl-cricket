<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class BallByBall extends Model
{
    protected $guarded = [];

    protected $casts = [
        'is_wicket' => 'boolean',
        'batsman_runs' => 'integer',
        'extra_runs' => 'integer',
    ];

    public function fixture(): BelongsTo
    {
        return $this->belongsTo(Fixture::class);
    }
    public function bowler(): BelongsTo
    {
        return $this->belongsTo(Player::class, 'bowler_id');
    }
    public function batsman(): BelongsTo
    {
        return $this->belongsTo(Player::class, 'batsman_id');
    }
    public function nonStriker(): BelongsTo
    {
        return $this->belongsTo(Player::class, 'non_striker_id');
    }
    public function dismissedPlayer(): BelongsTo
    {
        return $this->belongsTo(Player::class, 'dismissed_player_id');
    }
}
