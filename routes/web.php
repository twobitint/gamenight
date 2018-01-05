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

Route::get('hot', function () {
    return view('boardgames')->with(['source' => '/api/hot']);
});

Route::get('/bests/{players}/{username?}', function ($players, $username = null) {
    return view('boardgames')->with(['source' => route('api-bests', $players, $username)]);
})->name('bests');

Route::get('/home', 'HomeController@index');

/*
|--------------------------------------------------------------------------
| Laravel Authentication Routes
|--------------------------------------------------------------------------
|
| These are generated via the laravel authentication system
|
*/

Route::get('auth/{provider}', 'Auth\ProviderAuthController@redirectToProvider');
Route::get('auth/{provider}/callback', 'Auth\ProviderAuthController@handleProviderCallback');

Auth::routes();
