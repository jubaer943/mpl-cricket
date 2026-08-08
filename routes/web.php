<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('registration/team', function () {
    return view('team-registration');
});

Route::get('registration/player', function () {
    return view('player-registration');
});
