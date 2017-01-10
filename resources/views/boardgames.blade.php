@extends('layouts.app')

@section('content')
    <div class="boardgame-list">
        @foreach($games as $game)
            <boardgame
                :data="{!! htmlentities($game->toJson()) !!}"
            ></boardgame>
        @endforeach
    </div>
@endsection
