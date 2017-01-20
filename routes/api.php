<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::get('user', function (Request $request) {
    return $request->user();
})->middleware('auth:api');

Route::group(['middleware' => 'auth:api'], function () {
    Route::resource('boardgames', 'BoardgameController', ['only' => [
        'index', 'show'
    ]]);

    Route::get('hot', function () {
        return response()->json(
            App\Boardgame::with('tags', 'ranks')
                ->orderBy('hot_at', 'desc')
                ->orderBy('rating_average', 'desc')
                ->paginate(5)
        );
    });

    Route::group(['prefix' => 'user/{username}'], function () {
        Route::get('collection', 'CollectionController@forUser');
    });

});
