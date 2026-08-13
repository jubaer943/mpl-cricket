<?php

namespace App\Services;

use App\Models\BallByBall;
use App\Models\Fixture;
use App\Models\MatchPlayerStat;
use Illuminate\Support\Facades\DB;

class CricketScoreService
{
    public function recordBall(array $data): BallByBall
    {
        return DB::transaction(function () use ($data) {
            // ওয়াইড/নো বল হলে অটো ১ রান
            if (in_array($data['extra_type'], ['wide', 'no_ball'])) {
                $data['extra_runs'] = max(1, $data['extra_runs'] ?? 1);
            }

            $ball = BallByBall::create($data);

            $this->updatePlayerStats($ball);
            $this->updateFixtureSummary($ball->fixture_id, $ball->innings_number);

            return $ball;
        });
    }

    private function updatePlayerStats(BallByBall $ball): void
    {
        // ব্যাটার স্ট্যাটাস
        $batsmanStat = MatchPlayerStat::firstOrCreate(
            ['fixture_id' => $ball->fixture_id, 'player_id' => $ball->batsman_id],
            ['team_id' => $ball->batsman->team_id ?? null]
        );

        if (!in_array($ball->extra_type, ['wide'])) {
            $batsmanStat->increment('balls_faced');
        }

        if ($ball->batsman_runs > 0) {
            $batsmanStat->increment('runs_scored', $ball->batsman_runs);
            if ($ball->batsman_runs == 4) $batsmanStat->increment('fours');
            if ($ball->batsman_runs == 6) $batsmanStat->increment('sixes');
        }

        if ($ball->is_wicket && $ball->dismissed_player_id == $ball->batsman_id) {
            $batsmanStat->update(['out_type' => $ball->wicket_type ?? 'out']);
        }

        // বোলার স্ট্যাটাস
        $bowlerStat = MatchPlayerStat::firstOrCreate(
            ['fixture_id' => $ball->fixture_id, 'player_id' => $ball->bowler_id],
            ['team_id' => $ball->bowler->team_id ?? null]
        );

        $runsConceded = $ball->batsman_runs;
        if (in_array($ball->extra_type, ['wide', 'no_ball'])) {
            $runsConceded += $ball->extra_runs;
        }
        $bowlerStat->increment('runs_conceded', $runsConceded);

        if ($ball->is_wicket && $ball->wicket_type !== 'run_out') {
            $bowlerStat->increment('wickets_taken');
        }

        $legalBalls = BallByBall::where('fixture_id', $ball->fixture_id)
            ->where('bowler_id', $ball->bowler_id)
            ->whereNotIn('extra_type', ['wide', 'no_ball'])
            ->count();

        $overs = floor($legalBalls / 6);
        $balls = $legalBalls % 6;
        $bowlerStat->update(['overs_bowled' => "{$overs}.{$balls}"]);
    }

    public function updateFixtureSummary(int $fixtureId, int $inningsNumber): void
    {
        $fixture = Fixture::findOrFail($fixtureId);

        $balls = BallByBall::where('fixture_id', $fixtureId)
            ->where('innings_number', $inningsNumber)
            ->get();

        $totalRuns = $balls->sum('batsman_runs') + $balls->sum('extra_runs');
        $wickets = $balls->where('is_wicket', true)->count();

        $legalBalls = $balls->whereNotIn('extra_type', ['wide', 'no_ball'])->count();
        $overs = floor($legalBalls / 6);
        $remainingBalls = $legalBalls % 6;

        $formattedScore = "{$totalRuns}/{$wickets}";
        $formattedOvers = "{$overs}.{$remainingBalls}";

        // টসের ভিত্তিতে ১ম ইনিংসে কে ব্যাট করছে জানা
        $battingFirstTeamId = $this->getBattingTeamId($fixture, 1);

        if ($fixture->team_one_id == $battingFirstTeamId) {
            if ($inningsNumber == 1) {
                $fixture->update(['team_one_score' => $formattedScore, 'team_one_overs' => $formattedOvers]);
            } else {
                $fixture->update(['team_two_score' => $formattedScore, 'team_two_overs' => $formattedOvers]);
            }
        } else {
            if ($inningsNumber == 1) {
                $fixture->update(['team_two_score' => $formattedScore, 'team_two_overs' => $formattedOvers]);
            } else {
                $fixture->update(['team_one_score' => $formattedScore, 'team_one_overs' => $formattedOvers]);
            }
        }
    }

    public function getBattingTeamId(Fixture $fixture, int $inningsNumber): int
    {
        $tossWinner = $fixture->toss_winner_team_id;
        $tossDecision = $fixture->toss_decision; // 'bat' or 'bowl'

        if (!$tossWinner || !$tossDecision) {
            return $inningsNumber == 1 ? $fixture->team_one_id : $fixture->team_two_id;
        }

        $otherTeamId = ($tossWinner == $fixture->team_one_id) ? $fixture->team_two_id : $fixture->team_one_id;

        if ($inningsNumber == 1) {
            return ($tossDecision == 'bat') ? $tossWinner : $otherTeamId;
        } else {
            return ($tossDecision == 'bat') ? $otherTeamId : $tossWinner;
        }
    }
}
