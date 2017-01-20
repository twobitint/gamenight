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
        //$games = Auth::user()->games()->with('tags');

        return view('collection')->with([
            'source' => '/api/user/' . Auth::user()->username . '/collection'
        ]);
    }
}
