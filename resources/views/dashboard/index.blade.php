@extends('layouts.layout')

@section('content')
    <div class="text-[#fafafa] p-6">

        <div class="flex justify-between">
            <div class="text-2xl font-bold tracking-tight text-[#fafafa]">Calendar settings</div>
        </div>
        <hr class="my-[24px] border-[#27272a]">
        <div class="text-lg font-medium pr-2">Holiday</div>
        <div>
            <div class="grid grid-cols-7 text-center">
                <div class="p-1 text-[#a1a1aa]">Su</div>
                <div class="p-1 text-[#a1a1aa]">Mo</div>
                <div class="p-1 text-[#a1a1aa]">Tu</div>
                <div class="p-1 text-[#a1a1aa]">We</div>
                <div class="p-1 text-[#a1a1aa]">Th</div>
                <div class="p-1 text-[#a1a1aa]">Fr</div>
                <div class="p-1 text-[#a1a1aa]">Sa</div>
            </div>
            @foreach ($weeks as $week)
                <div class="grid grid-cols-7 text-center">
                    @foreach ($week as $day)
                        <div class="p-2">
                            {{ $day['day'] }}</div>
                    @endforeach
                </div>
            @endforeach
        </div>

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
    </div>
@endsection
