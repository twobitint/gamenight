@extends('layouts.app')

@section('content')
    @foreach($games as $game)
        <boardgame
            :data="{!! htmlentities($game->toJson()) !!}"
        ></boardgame>
    @endforeach
@endsection
