@extends('layouts.layout')

@section('content')
    <div>
        User: {{ auth()->user()->name }}
        Id: {{ auth()->user()->id }}

        @foreach ($events_list as $event)
            <div>
                <div>{{ $event[0] }}</div>
                <div>
                    <div>{{ $event[1] }}</div>
                    <div>{{ $event[2] }}</div>
                </div>
            </div>
        @endforeach
    </div>
@endsection
