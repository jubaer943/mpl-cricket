<?php

namespace App\Http\Controllers;

use App\Models\Player;
use App\Models\Team;
use App\Models\Tournament;
use App\Services\PlayerPerformanceService;
use Illuminate\Http\Request;

class HomeController extends Controller
{

    public function index(PlayerPerformanceService $service)
    {
        $teams = Team::select(['id', 'logo', 'name', 'owner_name', 'district', 'village'])
            ->withCount('players')
            ->latest()
            ->get();


        $tournaments = Tournament::select('id', 'name', 'status', 'total_matches', 'champion_team_id')
            ->withCount('teams')
            ->latest()
            ->get();
        $playerTotal = Player::all()->count();
        $playerData = $service->getDashboardData(10);


        return view('welcome', compact('teams', 'tournaments', 'playerData', 'playerTotal'));
    }
}
