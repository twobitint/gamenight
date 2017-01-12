<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;

use App\Boardgame;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function collection()
    {
        $games = Boardgame::with('tags')
            ->join('owned', 'owned.game_id', 'games.id')
            ->where('owned.user', Auth::user()->username)
            ->paginate(25);

        return view('boardgames')->with([
            'games' => $games
        ]);
    }
}
