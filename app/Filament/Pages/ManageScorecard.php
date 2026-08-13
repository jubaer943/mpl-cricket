<?php

namespace App\Filament\Pages;

use App\Models\BallByBall;
use App\Models\Fixture;
use App\Models\MatchPlayerStat;
use Filament\Notifications\Notification;
use Filament\Pages\Page;
use Filament\Support\Icons\Heroicon;
use BackedEnum;

class ManageScorecard extends Page
{
    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedRectangleStack;
    protected string $view = 'filament.pages.manage-scorecard';
    protected static bool $shouldRegisterNavigation = false;

    public $fixtureId;
    public $fixture;

    // Toss Inputs (Database Column: toss_winner_team_id, toss_decision)
    public $toss_winner_team_id;
    public $toss_decision;

    // Match State Variables
    public $innings_number = 1;
    public $battingTeam;
    public $bowlingTeam;
    public $total_overs = 20;

    // Live Ball Inputs
    public $batsman_id;
    public $non_striker_id;
    public $bowler_id;
    public $last_bowler_id;
    public $batsman_runs = 0;
    public $extra_type = '';

    // Over Tracking
    public $over_number = 0;
    public $ball_number = 1;
    public $valid_balls_in_over = 0;

    // Out Modal State
    public $showWicketModal = false;
    public $dismissed_player_id;
    public $wicket_type = 'bowled';
    public $new_batsman_id;

    public function mount(): void
    {
        $this->fixtureId = request()->query('fixtureId') ?? request()->route('record');
        $this->loadMatchData();
    }

    public function loadMatchData(): void
    {
        $this->fixture = Fixture::with(['teamOne.players', 'teamTwo.players', 'tossWinner'])->findOrFail($this->fixtureId);

        // 🔴 database column: total_overs & current_innings
        $this->total_overs = $this->fixture->total_overs ?? 20;
        $this->innings_number = $this->fixture->current_innings ?? 1;

        $this->toss_winner_team_id = $this->fixture->toss_winner_team_id;
        $this->toss_decision = $this->fixture->toss_decision;

        if ($this->toss_winner_team_id && $this->toss_decision) {
            $this->determineInningsAndTeams();
        }

        $this->calculateCurrentOverAndBall();
    }

    public function determineInningsAndTeams(): void
    {
        $tossWinnerId = $this->toss_winner_team_id;

        // ১ম ইনিংসের ব্যাটিং টিম নির্ধারণ
        $isTeamOneBattingFirst = ($tossWinnerId == $this->fixture->team_one_id && $this->toss_decision == 'bat') ||
            ($tossWinnerId == $this->fixture->team_two_id && $this->toss_decision == 'bowl');

        if ($this->innings_number == 1) {
            $this->battingTeam = $isTeamOneBattingFirst ? $this->fixture->teamOne : $this->fixture->teamTwo;
            $this->bowlingTeam = $isTeamOneBattingFirst ? $this->fixture->teamTwo : $this->fixture->teamOne;
        } else {
            $this->battingTeam = $isTeamOneBattingFirst ? $this->fixture->teamTwo : $this->fixture->teamOne;
            $this->bowlingTeam = $isTeamOneBattingFirst ? $this->fixture->teamOne : $this->fixture->teamTwo;
        }
    }

    public function saveToss(): void
    {
        $this->validate([
            'toss_winner_team_id' => 'required',
            'toss_decision' => 'required',
        ]);

        $this->fixture->update([
            'toss_winner_team_id' => $this->toss_winner_team_id,
            'toss_decision' => $this->toss_decision,
            'current_innings' => 1,
            'status' => 'live',
        ]);

        $this->loadMatchData();

        Notification::make()->title('টস ও ইনিংস সফলভাবে সেভ করা হয়েছে!')->success()->send();
    }

    public function calculateCurrentOverAndBall(): void
    {
        $totalValidBalls = BallByBall::where('fixture_id', $this->fixtureId)
            ->where('innings_number', $this->innings_number)
            ->whereNotIn('extra_type', ['wide', 'no_ball'])
            ->count();

        $this->over_number = floor($totalValidBalls / 6);
        $this->valid_balls_in_over = $totalValidBalls % 6;
        $this->ball_number = $this->valid_balls_in_over + 1;

        $lastBall = BallByBall::where('fixture_id', $this->fixtureId)
            ->where('innings_number', $this->innings_number)
            ->latest()
            ->first();

        if ($lastBall) {
            // 🔴 FIX: বোলার শুধু ওভার শেষ হলেই ব্লক হবে, ওভার চলাকালীন একই বোলার থাকবে
            if ($this->valid_balls_in_over == 0 && $totalValidBalls > 0) {
                $this->last_bowler_id = $lastBall->bowler_id;
                if ($this->bowler_id == $this->last_bowler_id) {
                    $this->bowler_id = null;
                }
            } else {
                $this->bowler_id = $lastBall->bowler_id;
                $this->last_bowler_id = null;
            }
        }
    }

    public function swapStrike(): void
    {
        $temp = $this->batsman_id;
        $this->batsman_id = $this->non_striker_id;
        $this->non_striker_id = $temp;
    }

    public function submitBall(): void
    {
        $this->validate([
            'batsman_id' => 'required',
            'non_striker_id' => 'required',
            'bowler_id' => 'required',
        ]);

        $isExtra = in_array($this->extra_type, ['wide', 'no_ball']);
        $extraRuns = $isExtra ? 1 : 0;

        // 🔴 FIX: ball_by_balls টেবিলে total_runs কলাম নেই, তাই শুধু সঠিক কলামে এন্ট্রি
        BallByBall::create([
            'fixture_id' => $this->fixtureId,
            'innings_number' => $this->innings_number,
            'over_number' => $this->over_number,
            'ball_number' => $this->ball_number,
            'bowler_id' => $this->bowler_id,
            'batsman_id' => $this->batsman_id,
            'non_striker_id' => $this->non_striker_id,
            'batsman_runs' => $this->batsman_runs,
            'extra_runs' => $extraRuns,
            'extra_type' => $this->extra_type ?: null,
            'is_wicket' => false,
        ]);

        // প্লেয়ার ও বোলিং স্ট্যাট আপডেট
        $this->updatePlayerStats($this->batsman_id, $this->battingTeam->id, $this->batsman_runs, !$isExtra, $this->batsman_runs == 4, $this->batsman_runs == 6);
        $this->updateBowlerStats($this->bowler_id, $this->bowlingTeam->id, ($this->batsman_runs + $extraRuns), !$isExtra, 0);

        // 🔴 FIX: ব্যাকএন্ডের SUM ক্যোয়ারি দিয়ে স্কোর রিক্যালকুলেট
        $this->updateFixtureScore();

        // ১/৩ রান অথবা ওভার শেষে স্ট্রাইক পরিবর্তন
        if ($this->batsman_runs % 2 != 0) {
            $this->swapStrike();
        }

        if (!$isExtra) {
            if ($this->valid_balls_in_over + 1 == 6) {
                $this->swapStrike();
            }
        }

        $this->resetBallInput();
        $this->loadMatchData();
    }

    public function openWicketModal(): void
    {
        $this->validate([
            'batsman_id' => 'required',
            'bowler_id' => 'required',
        ]);
        $this->dismissed_player_id = $this->batsman_id;
        $this->showWicketModal = true;
    }

    public function confirmWicket(): void
    {
        $this->validate([
            'dismissed_player_id' => 'required',
            'wicket_type' => 'required',
        ]);

        $isExtra = in_array($this->extra_type, ['wide', 'no_ball']);
        $extraRuns = $isExtra ? 1 : 0;

        BallByBall::create([
            'fixture_id' => $this->fixtureId,
            'innings_number' => $this->innings_number,
            'over_number' => $this->over_number,
            'ball_number' => $this->ball_number,
            'bowler_id' => $this->bowler_id,
            'batsman_id' => $this->batsman_id,
            'non_striker_id' => $this->non_striker_id,
            'batsman_runs' => $this->batsman_runs,
            'extra_runs' => $extraRuns,
            'extra_type' => $this->extra_type ?: null,
            'is_wicket' => true,
            'wicket_type' => $this->wicket_type,
            'dismissed_player_id' => $this->dismissed_player_id,
        ]);

        $this->updatePlayerStats($this->batsman_id, $this->battingTeam->id, $this->batsman_runs, !$isExtra, $this->batsman_runs == 4, $this->batsman_runs == 6, $this->wicket_type);
        $this->updateBowlerStats($this->bowler_id, $this->bowlingTeam->id, ($this->batsman_runs + $extraRuns), !$isExtra, 1);

        $this->updateFixtureScore();

        // নতুন ব্যাটার রিপ্লেসমেন্ট
        if ($this->dismissed_player_id == $this->batsman_id) {
            $this->batsman_id = $this->new_batsman_id;
        } else {
            $this->non_striker_id = $this->new_batsman_id;
        }

        $this->showWicketModal = false;
        $this->new_batsman_id = null;
        $this->resetBallInput();
        $this->loadMatchData();
    }

    private function updatePlayerStats($playerId, $teamId, $runs, $isLegalBall, $isFour, $isSix, $outType = null): void
    {
        $stat = MatchPlayerStat::firstOrCreate(
            ['fixture_id' => $this->fixtureId, 'player_id' => $playerId],
            ['team_id' => $teamId]
        );

        $stat->runs_scored += $runs;
        if ($isLegalBall) $stat->balls_faced += 1;
        if ($isFour) $stat->fours += 1;
        if ($isSix) $stat->sixes += 1;
        if ($outType) $stat->out_type = $outType;

        $stat->save();
    }

    private function updateBowlerStats($bowlerId, $teamId, $runsConceded, $isLegalBall, $wicketTaken): void
    {
        $stat = MatchPlayerStat::firstOrCreate(
            ['fixture_id' => $this->fixtureId, 'player_id' => $bowlerId],
            ['team_id' => $teamId]
        );

        $stat->runs_conceded += $runsConceded;
        if ($isLegalBall) {
            $stat->balls_bowled = ($stat->balls_bowled ?? 0) + 1;
            // 🔴 FIX: ১ বল হলে ০.১ ওভার হিসেবে নির্ভুল ফরম্যাটিং
            $overs = floor($stat->balls_bowled / 6) + (($stat->balls_bowled % 6) / 10);
            $stat->overs_bowled = $overs;
        }
        $stat->wickets_taken += $wicketTaken;

        $stat->save();
    }

    private function updateFixtureScore(): void
    {
        // 🔴 FIX: প্লেয়ারদের রানের সাথে ফিফচারের রান অমিল হওয়ার সমস্যা সমাধান
        $balls = BallByBall::where('fixture_id', $this->fixtureId)
            ->where('innings_number', $this->innings_number)
            ->get();

        $totalRuns = $balls->sum('batsman_runs') + $balls->sum('extra_runs');
        $totalWickets = $balls->where('is_wicket', true)->count();

        $legalBalls = $balls->whereNotIn('extra_type', ['wide', 'no_ball'])->count();
        $oversFormatted = floor($legalBalls / 6) . '.' . ($legalBalls % 6);

        $scoreFormatted = "{$totalRuns}/{$totalWickets}";

        if ($this->battingTeam->id == $this->fixture->team_one_id) {
            $this->fixture->update([
                'team_one_score' => $scoreFormatted,
                'team_one_overs' => $oversFormatted,
            ]);
        } else {
            $this->fixture->update([
                'team_two_score' => $scoreFormatted,
                'team_two_overs' => $oversFormatted,
            ]);
        }
    }

    private function resetBallInput(): void
    {
        $this->batsman_runs = 0;
        $this->extra_type = '';
    }

    public function getViewData(): array
    {
        $recentBalls = BallByBall::where('fixture_id', $this->fixtureId)
            ->where('innings_number', $this->innings_number)
            ->with(['batsman', 'bowler'])
            ->latest()
            ->take(12)
            ->get();

        return [
            'recentBalls' => $recentBalls,
        ];
    }
}
