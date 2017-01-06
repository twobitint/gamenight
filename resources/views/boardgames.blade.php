@extends('layouts.app')

@section('content')
    @foreach($games as $game)
        <boardgame
            name="{{ $game->name }}"
            description="{{ $game->description }}"
            thumbnail="{{ $game->thumbnail }}"
            image="{{ $game->image }}"
            rating-bayes="{{ $game->rating_bayes }}"
        ></boardgame>
    @endforeach
@endsection
