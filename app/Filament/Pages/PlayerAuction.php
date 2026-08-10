<?php

namespace App\Filament\Pages;

use App\Models\Category;
use App\Models\Player;
use App\Models\Team;
use Filament\Pages\Page;
use Filament\Notifications\Notification;

class PlayerAuction extends Page
{
    // protected static ?string $navigationIcon = 'heroicon-o-presentation-chart-line';
    protected static ?string $navigationLabel = 'প্লেয়ার নিলাম (Auction)';
    // protected static string $view = 'filament.pages.player-auction';

    public $selectedCategoryId = null;
    public $currentPlayer = null;
    public $currentBidPrice = 0;
    public $selectedTeamId = null;

    public function mount()
    {
        // ডিফল্টভাবে প্রথম ক্যাটাগরি লোড হবে
        $firstCategory = Category::first();
        if ($firstCategory) {
            $this->selectedCategoryId = $firstCategory->id;
            $this->loadNextPlayer();
        }
    }

    // ক্যাটাগরি পরিবর্তনের সাথে সাথে প্লেয়ার লোড
    public function updatedSelectedCategoryId()
    {
        $this->loadNextPlayer();
    }

    // নির্দিষ্ট ক্যাটাগরির পরবর্তী Available প্লেয়ার খুঁজে বের করা
    public function loadNextPlayer()
    {
        $this->selectedTeamId = null;

        $this->currentPlayer = Player::where('category_id', $this->selectedCategoryId)
            ->where('auction_status', 'available')
            ->first();

        if ($this->currentPlayer) {
            // বেস প্রাইস ক্যাটাগরি থেকে নেওয়া হচ্ছে
            $this->currentBidPrice = $this->currentPlayer->category->base_price ?? 0;
        } else {
            $this->currentBidPrice = 0;
        }
    }

    // এক ক্লিকে নির্দিষ্ট বিড ইনক্রিমেন্ট করা
    public function incrementBid()
    {
        if (!$this->currentPlayer) return;

        $increment = $this->currentPlayer->category->bid_increment ?? 100;
        $this->currentBidPrice += $increment;
    }

    // টিমের কাছে প্লেয়ার Sold করা (সর্বোচ্চ ১৫ জন স্কোয়াড লিমিট সহ)
    public function sellPlayer()
    {
        if (!$this->currentPlayer || !$this->selectedTeamId) {
            Notification::make()->title('অনুগ্রহ করে একটি টিম নির্বাচন করুন!')->danger()->send();
            return;
        }

        $team = Team::find($this->selectedTeamId);

        // টিম স্কোয়াড লিমিট (১৫ জন) চেক
        if ($team->players()->count() >= 15) {
            Notification::make()->title("{$team->name} ইতিমধ্যে ১৫ জন প্লেয়ার নিয়ে নিয়েছে!")->warning()->send();
            return;
        }

        // প্লেয়ার Sold হিসেবে আপডেট
        $this->currentPlayer->update([
            'team_id' => $this->selectedTeamId,
            'sold_price' => $this->currentBidPrice,
            'auction_status' => 'sold',
        ]);

        Notification::make()->title("{$this->currentPlayer->name} কে {$team->name} কিনে নিয়েছে!")->success()->send();

        // অটোমেটিক পরের প্লেয়ার লোড করা
        $this->loadNextPlayer();
    }

    // প্লেয়ার Unsold ঘোষণা করা
    public function markUnsold()
    {
        if (!$this->currentPlayer) return;

        $this->currentPlayer->update([
            'auction_status' => 'unsold',
        ]);

        Notification::make()->title("{$this->currentPlayer->name} Unsold ঘোষণা করা হলো")->warning()->send();

        $this->loadNextPlayer();
    }
}
