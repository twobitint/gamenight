<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| Protected API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::group(['middleware' => 'auth:api'], function () {
    Route::get('user', function (Request $request) {
        return $request->user();
    });

    Route::group(['prefix' => 'user/{username}'], function () {
        Route::get('collection', 'CollectionController@forUser');
    });
});

/*
|--------------------------------------------------------------------------
| Public API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::resource('boardgames', 'BoardgameController', ['only' => [
    'index', 'show'
]]);

Route::get('hot', function () {
    return response()->json(
        App\Boardgame::with('tags', 'ranks')
            ->whereNotNull('hot_at')
            ->orderBy('hot_at', 'desc')
            ->orderBy('rating_average', 'desc')
            ->paginate(5)
    );
})->name('hot');

Route::get('bests/{players}/{username?}', function ($players, $username = null) {
    return response()->json(
        App\Boardgame::with('tags', 'ranks')
            ->select('boardgames.*')
            ->join('bgg_recommendations', 'bgg_recommendations.boardgame_id', 'boardgames.id')
            ->where('bgg_recommendations.optimal', '>', '0.7')
            ->where('bgg_recommendations.players', $players)
            ->where('bgg_recommendations.or_more', 0)
            ->where('bgg_recommendations.weighted', '>=', 20)
            ->where('boardgames.type', 'boardgame')
            ->orderBy('boardgames.rank')
            ->paginate(5)
    );
})->name('bests');
