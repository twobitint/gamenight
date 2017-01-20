@extends('layouts.app')

@section('content')
    <game-collection
        :source="'{{ $source }}'">
    </game-collection>
@endsection
