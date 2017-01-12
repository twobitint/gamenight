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

Route::group(['prefix' => 'user', 'as' => 'user-'], function () {
    Route::any('collection', 'UserController@collection')->name('collection');
});

Route::get('/boardgames/{players}/{username?}', function ($players, $username = null) {

    //$games = DB::connection('bgdb')
    //    ->table('games')
    $games = App\Boardgame::with('tags')
        ->join('players', 'games.id', 'players.game_id')
        ->select(DB::raw('*, players.best + players.recommended as great'))
        ->whereRaw('great > 0.7')
        ->where('players.number', $players)
        ->where('players.or_more', 0)
        ->orderBy('games.rank')
        ->limit(8);

    if ($username) {
        $games->join('owned', 'owned.game_id', 'games.id')
            ->where('owned.user', $username);
    }

    return view('boardgames')->with([
        'games' => $games->get()
    ]);

    // return view('boardgames')->with([
    //     'games' => App\Game::all()
    //         ->
    // ]);
})->name('boardgames');

Auth::routes();

Route::get('/home', 'HomeController@index');
