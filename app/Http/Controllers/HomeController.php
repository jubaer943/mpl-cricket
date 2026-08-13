<?php

namespace App\Http\Controllers;

use App\Models\Player;
use App\Models\Team;
use App\Models\Tournament;
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

        $tournaments = Tournament::select('id', 'name', 'status', 'total_matches', 'champion_team_id')
            ->withCount('teams')
            ->latest()
            ->get();

        return view('welcome', compact('teams', 'players', 'tournaments'));
    }
}
