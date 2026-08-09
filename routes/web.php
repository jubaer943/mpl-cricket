<?php

use App\Http\Controllers\TeamController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
})->name('home');

Route::prefix('registration')->group(function () {
    Route::get('/team', [TeamController::class, 'index'])->name('team.register');
    Route::post('/team', [TeamController::class, 'store'])->name('team.store');
    Route::get('/player', function () {
        return view('player-registration');
    })->name('player.register');
});
