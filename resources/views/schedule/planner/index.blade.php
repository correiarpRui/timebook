@extends('layouts.layout')

@section('content')
    <div class="text-[#fafafa] p-6">
        <div class="flex justify-between">
            <div class="text-2xl font-bold tracking-tight text-[#fafafa]">Schedule Planner</div>

        </div>
        <hr class="my-[24px] border-[#27272a]">

        <div class="grid grid-cols-7">
            <div>Sun</div>
            <div>Mon</div>
            <div>Tue</div>
            <div>Wen</div>
            <div>Thu</div>
            <div>Fri</div>
            <div>Sat</div>
        </div>
        @foreach ($weeks as $week)
            <div class="grid grid-cols-7">
                @foreach ($week as $day)
                    <div>{{ $day['day'] }}</div>
                @endforeach
            </div>
        @endforeach



    </div>
@endsection
