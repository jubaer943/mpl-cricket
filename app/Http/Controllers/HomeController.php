<?php

namespace App\Http\Controllers;

use App\Models\Player;
use App\Models\Team;
use Illuminate\Http\Request;

class HomeController extends Controller
{

    public function index()
    {
        $teams = Team::select(['id', 'logo', 'name', 'owner_name', 'district', 'village'])
            ->withCount('players')
            ->latest()
            ->get();

        $players = Player::select('id', 'name', 'player_role')
            ->latest()
            ->limit(10)
            ->get();

        return view('welcome', compact('teams', 'players'));
    }
}
