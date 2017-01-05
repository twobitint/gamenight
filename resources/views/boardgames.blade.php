@extends('layouts.app')

@section('content')
    @foreach($games as $game)
        <boardgame
            name="{{ $game->name }}"
            description="{{ $game->description }}"
            thumbnail="{{ $game->thumbnail }}"
        ></boardgame>
    @endforeach
@endsection
