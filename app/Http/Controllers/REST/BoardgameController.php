<?php

namespace App\Http\REST\Controllers;

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
