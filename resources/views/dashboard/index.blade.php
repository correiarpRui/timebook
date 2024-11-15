@extends('layouts.layout')

@section('content')
    <div>
        User: {{ auth()->user()->name }}
    </div>
@endsection
