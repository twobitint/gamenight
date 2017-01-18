@extends('layouts.app')

@section('content')
    <game-collection></game-collection>
    <table class="table table-striped table-bordered">
        <thead>
            <tr>
                <th>Name</th>
                <th>Rating</th>
                <th>Weight</th>
                <th>Categories</th>
            </tr>
        </thead>
        <tbody>
            @foreach($games as $game)
                <tr is="boardgame-row"
                    :data="{!! htmlentities($game->toJson()) !!}"
                ></tr>
            @endforeach
        </tbody>
    </table>
@endsection
