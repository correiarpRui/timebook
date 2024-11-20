@extends('layouts.layout')

@section('content')
    <div>
        User: {{ auth()->user()->name }}
        Id: {{ auth()->user()->id }}
    </div>
@endsection
