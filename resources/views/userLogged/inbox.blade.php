@extends('layouts.app')

@section('content')
    @foreach($filtered_messages as $fm)
        {{ $fm->apartament['title'] }}
    @endforeach
@endsection