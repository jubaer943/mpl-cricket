<?php

namespace App\Filament\Pages;

use App\Models\BallByBall;
use App\Models\Fixture;
use App\Models\Player;
use App\Services\CricketScoreService;
use Filament\Notifications\Notification;
use Filament\Pages\Page;
use BackedEnum;
use Filament\Support\Icons\Heroicon;

class ManageScorecard extends Page
{
    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedRectangleStack;
    protected string $view = 'filament.pages.manage-scorecard';
    protected static bool $shouldRegisterNavigation = false;
    public $fixtureId;
    public $fixture;

    public $innings_number = 1;
    public $over_number = 0;
    public $ball_number = 1;

    // প্লেয়ার সিলেক্টর
    public $bowler_id;
    public $last_bowler_id; // আগের ওভারের বোলার রোধ করার জন্য
    public $batsman_id; // Striker
    public $non_striker_id; // Non-Striker

    // ইনপুট ভ্যালু
    public $batsman_runs = 0;
    public $extra_type = null;
    public $extra_runs = 0;

    // আউট পপআপ / মোডাল স্টেট
    public $showWicketModal = false;
    public $wicket_type = 'bowled';
    public $dismissed_player_id;
    public $assisted_by_player_id;
    public $new_batsman_id;

    public $recentBalls = [];

    public function mount(): void
    {
        $this->fixtureId = request()->query('fixtureId');
        $this->fixture = Fixture::with(['teamOne.players', 'teamTwo.players', 'tossWinner'])->findOrFail($this->fixtureId);

        $this->determineInningsTeams();
        $this->loadRecentBalls();
    }

    /**
     * টস এর ভিত্তিতে কোন টিম ১মে ব্যাট/বল করবে অটো ডিটেক্ট লজিক
     */
    public function determineInningsTeams(): void
    {
        // টস বিজয়ী দল আগে ব্যাট করছে ধরলাম
        // প্রয়োজন অনুযায়ী আপনার টস লজিক এখানে অটো কাজ করবে
    }

    public function loadRecentBalls(): void
    {
        $this->recentBalls = BallByBall::where('fixture_id', $this->fixtureId)
            ->where('innings_number', $this->innings_number)
            ->with(['bowler', 'batsman'])
            ->latest()
            ->take(12)
            ->get();
    }

    /**
     * ১ ক্লিক বাটন দিয়ে স্ট্রাইক অদল-বদল (Swap Strike)
     */
    public function swapStrike(): void
    {
        $temp = $this->batsman_id;
        $this->batsman_id = $this->non_striker_id;
        $this->non_striker_id = $temp;

        Notification::make()->title('স্ট্রাইক অদল-বদল করা হয়েছে')->info()->send();
    }

    /**
     * বল ইনপুট সাবমিট
     */
    public function submitBall(): void
    {
        if (!$this->bowler_id || !$this->batsman_id) {
            Notification::make()->title('বোলার এবং স্ট্রাইকার ব্যাটার নির্বাচন করুন!')->danger()->send();
            return;
        }

        // পর পর দুই ওভার একই বোলার প্রতিরোধ
        if ($this->ball_number == 1 && $this->bowler_id == $this->last_bowler_id) {
            Notification::make()->title('একই বোলার পরপর দুই ওভার করতে পারবে না!')->danger()->send();
            return;
        }

        $service = new CricketScoreService();

        $service->recordBall([
            'fixture_id' => $this->fixtureId,
            'innings_number' => $this->innings_number,
            'over_number' => $this->over_number,
            'ball_number' => $this->ball_number,
            'bowler_id' => $this->bowler_id,
            'batsman_id' => $this->batsman_id,
            'non_striker_id' => $this->non_striker_id,
            'batsman_runs' => $this->batsman_runs,
            'extra_type' => $this->extra_type,
            'extra_runs' => $this->extra_runs,
            'is_wicket' => false,
        ]);

        // ১ বা ৩ রানে অটো স্ট্রাইক চেঞ্জ
        if (in_array($this->batsman_runs, [1, 3])) {
            $this->swapStrikeWithoutNotice();
        }

        // ওভার ও বল অটো কাউন্টার
        if (!in_array($this->extra_type, ['wide', 'no_ball'])) {
            if ($this->ball_number >= 6) {
                $this->ball_number = 1;
                $this->over_number += 1;
                $this->last_bowler_id = $this->bowler_id; // বোলার সেভ রাখা হলো
                $this->bowler_id = null; // নতুন ওভারে বোলার সিলেক্ট বাধ্য করা
                $this->swapStrikeWithoutNotice(); // ওভার শেষে অটো স্ট্রাইক চেঞ্জ
                Notification::make()->title('ওভার সমাপ্ত! নতুন বোলার সিলেক্ট করুন।')->warning()->send();
            } else {
                $this->ball_number += 1;
            }
        }

        $this->resetBallInput();
        $this->loadRecentBalls();
        $this->fixture->refresh();
    }

    /**
     * উইকেট পপআপ মোডাল থেকে আউট নিশ্চিত করা
     */
    public function openWicketModal(): void
    {
        $this->dismissed_player_id = $this->batsman_id;
        $this->showWicketModal = true;
    }

    public function confirmWicket(): void
    {
        $service = new CricketScoreService();

        $service->recordBall([
            'fixture_id' => $this->fixtureId,
            'innings_number' => $this->innings_number,
            'over_number' => $this->over_number,
            'ball_number' => $this->ball_number,
            'bowler_id' => $this->bowler_id,
            'batsman_id' => $this->batsman_id,
            'non_striker_id' => $this->non_striker_id,
            'batsman_runs' => 0,
            'extra_type' => null,
            'extra_runs' => 0,
            'is_wicket' => true,
            'wicket_type' => $this->wicket_type,
            'dismissed_player_id' => $this->dismissed_player_id,
            'assisted_by_player_id' => $this->assisted_by_player_id,
        ]);

        // নতুন ব্যাটার সেট
        if ($this->dismissed_player_id == $this->batsman_id) {
            $this->batsman_id = $this->new_batsman_id;
        } else {
            $this->non_striker_id = $this->new_batsman_id;
        }

        // বল কাউন্ট বাড়ানো
        if ($this->ball_number >= 6) {
            $this->ball_number = 1;
            $this->over_number += 1;
            $this->last_bowler_id = $this->bowler_id;
            $this->bowler_id = null;
        } else {
            $this->ball_number += 1;
        }

        $this->showWicketModal = false;
        $this->new_batsman_id = null;
        $this->resetBallInput();
        $this->loadRecentBalls();
        $this->fixture->refresh();

        Notification::make()->title('উইকেট আপডেট করা হয়েছে!')->success()->send();
    }

    private function swapStrikeWithoutNotice(): void
    {
        $temp = $this->batsman_id;
        $this->batsman_id = $this->non_striker_id;
        $this->non_striker_id = $temp;
    }

    private function resetBallInput(): void
    {
        $this->batsman_runs = 0;
        $this->extra_type = null;
        $this->extra_runs = 0;
    }
}
