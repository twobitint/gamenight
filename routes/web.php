<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('events');
})->name('events');

Route::get('/boardgames/{players}', function ($players) {
    return view('boardgames')->with([
        'games' => DB::connection('bgdb')
            ->table('games')
            ->join('players', 'games.id', 'players.game_id')
            ->select(DB::raw('*, players.best + players.recommended as great'))
            ->whereRaw('great > 0.7')
            ->where('players.number', $players)
            ->where('players.or_more', 0)
            ->orderBy('games.rank')
            ->limit(5)
            ->get()
    ]);
})->name('boardgames');
