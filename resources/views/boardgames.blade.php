@extends('layouts.app')

@section('content')
    @if (method_exists($games, 'total') && $games->total() >= 20)
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
        {{ $games->links('vendor.pagination.bootstrap-4') }}
    @else
        <div class="boardgame-list {{ $games->count() >= 10 ? 'card-columns' : '' }}">
            <div class="row justify-content-md-center">
                <div class="col-md-8">
                    @foreach($games as $game)
                        <boardgame-card
                            :data="{!! htmlentities($game->toJson()) !!}"
                        ></boardgame-card>
                    @endforeach
                </div>
            </div>
        </div>
    @endif
@endsection
