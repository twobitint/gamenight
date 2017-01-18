@extends('layouts.app')

@section('scripts')
    <script src="{{ asset('js/collection.js') }}"></script>
@endsection

@section('content')
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
