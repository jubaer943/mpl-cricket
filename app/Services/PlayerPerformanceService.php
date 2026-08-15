<?php


namespace App\Services;

use App\Models\Player;
use App\Models\Team;
use Illuminate\Support\Collection;

class PlayerPerformanceService
{
    /**
     * Get all players with calculated performance statistics.
     *
     * @param int|null $limit
     * @return Collection
     */
    public function getPlayers(?int $limit = null): Collection
    {
        $players = Player::query()
            ->whereNotNull('players.team_id')

            ->select(
                'players.id',
                'players.name',
                'players.player_role',
                'players.team_id'
            )

            ->leftJoin(
                'match_player_stats',
                'players.id',
                '=',
                'match_player_stats.player_id'
            )

            ->selectRaw('
                players.id as player_id,

                players.name,

                players.player_role,

                players.team_id,

                COALESCE(
                    SUM(match_player_stats.runs_scored),
                    0
                ) as total_runs,

                COALESCE(
                    COUNT(DISTINCT match_player_stats.fixture_id),
                    0
                ) as matches_played,

                COALESCE(
                    MAX(match_player_stats.runs_scored),
                    0
                ) as highest_score,

                COALESCE(
                    SUM(
                        CASE
                            WHEN match_player_stats.runs_scored >= 50
                            AND match_player_stats.runs_scored < 100
                            THEN 1
                            ELSE 0
                        END
                    ),
                    0
                ) as fifties,

                COALESCE(
                    SUM(
                        CASE
                            WHEN match_player_stats.runs_scored >= 100
                            THEN 1
                            ELSE 0
                        END
                    ),
                    0
                ) as hundreds,

                COALESCE(
                    SUM(match_player_stats.wickets_taken),
                    0
                ) as total_wickets,

                COALESCE(
                    SUM(match_player_stats.balls_bowled),
                    0
                ) as total_balls_bowled,

                COALESCE(
                    SUM(match_player_stats.runs_conceded),
                    0
                ) as total_runs_conceded,

                COALESCE(
                    SUM(match_player_stats.fours),
                    0
                ) as total_fours,

                COALESCE(
                    SUM(match_player_stats.sixes),
                    0
                ) as total_sixes,

                COALESCE(
                    SUM(match_player_stats.catches),
                    0
                ) as total_catches,

                COALESCE(
                    SUM(match_player_stats.stumpings),
                    0
                ) as total_stumpings,

                COALESCE(

                    (
                        SUM(match_player_stats.runs_scored) * 1
                    )

                    +

                    (
                        SUM(match_player_stats.wickets_taken) * 25
                    )

                    +

                    (
                        SUM(match_player_stats.fours) * 1
                    )

                    +

                    (
                        SUM(match_player_stats.sixes) * 2
                    )

                    +

                    (
                        SUM(match_player_stats.catches) * 8
                    )

                    +

                    (
                        SUM(match_player_stats.stumpings) * 12
                    )

                    +

                    (
                        SUM(
                            CASE
                                WHEN match_player_stats.runs_scored >= 50
                                AND match_player_stats.runs_scored < 100
                                THEN 1
                                ELSE 0
                            END
                        ) * 8
                    )

                    +

                    (
                        SUM(
                            CASE
                                WHEN match_player_stats.runs_scored >= 100
                                THEN 1
                                ELSE 0
                            END
                        ) * 16
                    ),

                    0

                ) as performance_score
            ')

            ->with('team:id,name')

            ->groupBy(
                'players.id',
                'players.name',
                'players.player_role',
                'players.team_id'
            )

            ->get();


        /*
        |--------------------------------------------------------------------------
        | Economy Rate
        |--------------------------------------------------------------------------
        */

        $players->transform(function ($player) {

            $balls =
                (int) $player->total_balls_bowled;

            $runsConceded =
                (int) $player->total_runs_conceded;


            if ($balls > 0) {

                $overs =
                    $balls / 6;

                $player->economy_rate =
                    round(
                        $runsConceded / $overs,
                        2
                    );
            } else {

                $player->economy_rate = 0;
            }


            return $player;
        });


        /*
        |--------------------------------------------------------------------------
        | Optional Limit
        |--------------------------------------------------------------------------
        |
        | null = unlimited
        |
        */

        if ($limit !== null) {
            return $players->take($limit)->values();
        }


        return $players->values();
    }


    /**
     * Top performers by performance score.
     */
    public function getTopPerformers(?int $limit = null): Collection
    {
        return $this->getPlayers()
            ->sortByDesc('performance_score')
            ->when(
                $limit !== null,
                fn($collection) => $collection->take($limit)
            )
            ->values();
    }


    /**
     * Top run scorers.
     */
    public function getTopRunScorers(?int $limit = null): Collection
    {
        return $this->getPlayers()
            ->sortByDesc('total_runs')
            ->when(
                $limit !== null,
                fn($collection) => $collection->take($limit)
            )
            ->values();
    }


    /**
     * Top wicket takers.
     */
    public function getTopWicketTakers(?int $limit = null): Collection
    {
        return $this->getPlayers()
            ->sortByDesc('total_wickets')
            ->when(
                $limit !== null,
                fn($collection) => $collection->take($limit)
            )
            ->values();
    }


    /**
     * Teams for filters.
     */
    public function getTeams(): Collection
    {
        return Team::query()
            ->select('id', 'name')
            ->get();
    }


    /**
     * Get everything needed for player performance pages.
     */
    public function getDashboardData(?int $limit = null): array
    {
        return [

            'topPerformers' =>
            $this->getTopPerformers($limit),

            'topRunScorers' =>
            $this->getTopRunScorers($limit),

            'topWicketTakers' =>
            $this->getTopWicketTakers($limit),

            'teams' =>
            $this->getTeams(),

        ];
    }
}
