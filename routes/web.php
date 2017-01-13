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
        ->join('bgg_recommendations', 'boardgames.id', 'bgg_recommendations.boardgame_id')
        ->where('optimal', '>', '0.7')
        ->where('bgg_recommendations.players', $players)
        ->where('bgg_recommendations.or_more', 0)
        ->orderBy('boardgames.rank')
        ->limit(8);

    if ($username) {
        $games->join('owned', 'owned.game_id', 'boardgames.id')
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
