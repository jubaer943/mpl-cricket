<?php

namespace App\Filament\Pages;

use App\Models\Category;
use App\Models\Player;
use App\Models\Team;
use Filament\Pages\Page;
use Filament\Notifications\Notification;
use BackedEnum;
use Filament\Support\Icons\Heroicon;

class PlayerAuction extends Page
{
    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedRectangleStack;
    protected static ?string $navigationLabel = 'প্লেয়ার নিলাম (Auction)';
    protected string $view = 'filament.pages.player-auction';

    public $selectedCategoryId = null;
    public $currentPlayer = null;
    public $currentBidPrice = 0;
    public $biddingTeamId = null;
    public $lastAuctionState = null; // sold or unsold state tracking

    public function mount(): void
    {
        $firstCategory = Category::first();
        if ($firstCategory) {
            $this->selectedCategoryId = $firstCategory->id;
            $this->loadNextPlayer();
        }
    }

    public function updatedSelectedCategoryId(): void
    {
        $this->loadNextPlayer();
    }

    public function loadNextPlayer(): void
    {
        $this->biddingTeamId = null;
        $this->lastAuctionState = null;

        $this->currentPlayer = Player::where('category_id', $this->selectedCategoryId)
            ->where('auction_status', 'bidding')
            ->where('is_auction_active', true)
            ->first();

        if (!$this->currentPlayer) {
            $this->currentPlayer = Player::where('category_id', $this->selectedCategoryId)
                ->where('auction_status', 'available')
                ->first();
        }

        if ($this->currentPlayer) {
            $this->currentBidPrice = $this->currentPlayer->category->base_price ?? 0;

            Player::where('is_auction_active', true)->update(['is_auction_active' => false]);
            $this->currentPlayer->update(['is_auction_active' => true]);
        } else {
            Player::where('is_auction_active', true)->update(['is_auction_active' => false]);
            $this->currentBidPrice = 0;
        }
    }

    public function placeBid($teamId): void
    {
        if (!$this->currentPlayer || $this->lastAuctionState) return;

        $team = Team::find($teamId);
        if ($team->players()->count() >= 15) {
            Notification::make()->title("{$team->name} টিমে ১৫ জন প্লেয়ার পূর্ণ!")->warning()->send();
            return;
        }

        $this->biddingTeamId = $teamId;
        $increment = $this->currentPlayer->category->bid_increment ?? 100;

        if ($this->currentPlayer->sold_price > 0) {
            $this->currentBidPrice += $increment;
        } else {
            if ($this->currentBidPrice == 0) {
                $this->currentBidPrice = $this->currentPlayer->category->base_price ?? 0;
            }
        }

        $this->currentPlayer->update([
            'team_id' => $this->biddingTeamId,
            'sold_price' => $this->currentBidPrice,
            'auction_status' => 'bidding'
        ]);
    }

    public function sellPlayer(): void
    {
        if (!$this->currentPlayer || !$this->biddingTeamId) {
            Notification::make()->title('বিড করার জন্য কোনো টিম সিলেক্ট করা হয়নি!')->danger()->send();
            return;
        }

        $team = Team::find($this->biddingTeamId);

        $this->currentPlayer->update([
            'team_id' => $this->biddingTeamId,
            'sold_price' => $this->currentBidPrice,
            'auction_status' => 'sold',
            'is_auction_active' => true, // স্ক্রিনে স্টেট দেখানোর জন্য active রাখা হয়েছে
        ]);

        $this->lastAuctionState = 'sold';

        Notification::make()->title("{$this->currentPlayer->name} কে {$team->name} কিনে নিয়েছে!")->success()->send();
    }

    public function markUnsold(): void
    {
        if (!$this->currentPlayer) return;

        $this->currentPlayer->update([
            'team_id' => null,
            'sold_price' => 0,
            'auction_status' => 'unsold',
            'is_auction_active' => true,
        ]);

        $this->lastAuctionState = 'unsold';

        Notification::make()->title("{$this->currentPlayer->name} Unsold ঘোষণা করা হলো")->warning()->send();
    }
}
