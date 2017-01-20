@extends('layouts.app')

@section('content')
    <game-cardlist
        :source="'{{ $source }}'">
    </game-cardlist>
@endsection
