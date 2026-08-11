<?php

namespace App\Http\Controllers;

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

        return view('welcome', compact('teams'));
    }
}
