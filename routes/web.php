<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\PlayerController;
use App\Http\Controllers\TeamController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PublicAuctionController;

Route::get('/', [HomeController::class, 'index'])->name('home');

Route::prefix('registration')->group(function () {
    Route::get('/team', [TeamController::class, 'index'])->name('team.register');
    Route::post('/team', [TeamController::class, 'store'])->name('team.store');
    Route::get('/player', function () {
        return view('player-registration');
    })->name('player.register');

    Route::post('player', [PlayerController::class, 'store'])->name('player.store');
});

Route::get('commitee/mpl', function () {
    return view("commitee-mpl");
})->name('commitee.mpl');

Route::get('commitee', function () {
    return view("commitee");
})->name('commitee');

Route::get('player/performance', [PlayerController::class, 'topPerformer'])->name('player.performance');
Route::get('register/player', [PlayerController::class, 'registerPlayer'])->name('register.player');



Route::get('/live-draft', [PublicAuctionController::class, 'index']);
Route::get('/api/live-draft-data', [PublicAuctionController::class, 'getLiveAuctionData']);

Route::get('fixture', function () {
    return view('fixture');
})->name('tournament.fixture');
