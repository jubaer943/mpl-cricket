<?php

namespace App\Http\Controllers;

use App\Models\Player;

class PublicAuctionController extends Controller
{
    public function index()
    {
        return view('public-auction');
    }

    public function getLiveAuctionData()
    {
        $player = Player::where('is_auction_active', true)
            ->with(['category', 'team'])
            ->first();

        if (!$player) {
            return response()->json(['is_live' => false]);
        }

        return response()->json([
            'is_live' => true,
            'player' => [
                'name' => $player->name,
                'photo' => asset('storage/' . $player->photo),
                'role' => $player->player_role,
                'batting_style' => $player->batting_style,
                'grade' => $player->grade,
                'category_name' => $player->category->name ?? 'N/A',
                'current_price' => $player->sold_price > 0 ? $player->sold_price : ($player->category->base_price ?? 0),
                'bid_increment' => $player->category->bid_increment ?? 100, // প্রতি বিডে কত বাড়বে
                'auction_status' => $player->auction_status,
                'bidding_team_name' => $player->team->name ?? null, // যে টিম এখন বিড করে আছে
                'bidding_team_logo' => $player->team && $player->team->logo ? asset('storage/' . $player->team->logo) : null,
            ]
        ]);
    }
}
