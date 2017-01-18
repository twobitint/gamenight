<?php

namespace App\Http\Controllers\REST;

use Illuminate\Http\Request;

use Auth;

use App\Http\Controllers\Controller;
use App\Boardgame;
use App\User;

class CollectionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function forUser($username)
    {
        if ($username == 'me') {
            return $this->forMe();
        }

        $user = User::where('username', $username)->first();

        if ($user) {
            return response()->json($user->games()->with('tags')->get());
        } else {
            abort(404);
        }
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function forMe()
    {
        dd(Auth::user());
        $games = Auth::user()->games()->with('tags')->get();

        return response()->json($games);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $game = Boardgame::find($id);

        return response()->json($game);
    }
}
