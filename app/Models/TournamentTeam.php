<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\Pivot;

class TournamentTeam extends Pivot
{
    // টেবিল নাম নির্দিষ্ট করে দেওয়া হলো
    protected $table = 'tournament_team';

    protected $guarded = [];

    protected $casts = [
        'points' => 'integer',
    ];

    /**
     * সংশ্লিষ্ট টুর্নামেন্ট
     */
    public function tournament(): BelongsTo
    {
        return $this->belongsTo(Tournament::class);
    }

    /**
     * সংশ্লিষ্ট টিম
     */
    public function team(): BelongsTo
    {
        return $this->belongsTo(Team::class);
    }
}
