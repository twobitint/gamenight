<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Boardgame;

class BoardgameController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $games = Boardgame::all()->take(20);

        return view('boardgames')->with([
            'games' => $games
        ]);
    }
}
