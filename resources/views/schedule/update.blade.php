@extends('layouts.layout')

@section('content')
    <div class="py-10 px-5">
        <div>
            Update Schedule
        </div>
        <form action="{{ route('schedule.patch', $schedule->id) }}" method="POST" class="flex flex-col gap-2">
            @csrf
            @method('PATCH')
            <label for="name">Name</label>
            <input type="text" name="name" value="{{ $schedule->name }}">
            @error('name')
                <div class="text-red-600">{{ $message }}</div>
            @enderror

            <label for="morning_start">Morning Start</label>
            <input type="time" name="morning_start" value="{{ $schedule->morning_start }}">
            @error('morning_start')
                <div class="text-red-600">{{ $message }}</div>
            @enderror

            <label for="morning_end">Morning End</label>
            <input type="time" name="morning_end" value="{{ $schedule->morning_end }}">
            @error('morning_end')
                <div class="text-red-600">{{ $message }}</div>
            @enderror

            <label for="afternoon_start">Afternoon Start</label>
            <input type="time" name="afternoon_start" value="{{ $schedule->afternoon_start }}">
            @error('afternoon_start')
                <div class="text-red-600">{{ $message }}</div>
            @enderror

            <label for="afternoon_end">Afternoon End</label>
            <input type="time" name="afternoon_end" value="{{ $schedule->afternoon_end }}">
            @error('afternoon_end')
                <div class="text-red-600">{{ $message }}</div>
            @enderror

            <fieldset>
                <legend>Work Days</legend>

                <input type="checkbox" name="monday" id="monday" {{ $schedule->monday ? 'checked' : '' }}>
                <label for="monday">Monday</label>

                <input type="checkbox" name="tuesday" id="tuesday" {{ $schedule->tuesday ? 'checked' : '' }}>
                <label for="tuesday">Tuesday</label>

                <input type="checkbox" name="wednesday" id="wednesday" {{ $schedule->wednesday ? 'checked' : '' }}>
                <label for="wednesday">Wednesday</label>

                <input type="checkbox" name="thursday" id="thursday" {{ $schedule->thursday ? 'checked' : '' }}>
                <label for="thursday">Thursday</label>

                <input type="checkbox" name="friday" id="friday" {{ $schedule->friday ? 'checked' : '' }}>
                <label for="friday">Friday</label>

                <input type="checkbox" name="saturday" id="saturday" {{ $schedule->saturday ? 'checked' : '' }}>
                <label for="saturday">Saturday</label>

                <input type="checkbox" name="sunday" id="sunday" {{ $schedule->sunday ? 'checked' : '' }}>
                <label for="sunday">Sunday</label>
            </fieldset>
            <button class="bg-orange-400 rounded-md">Submit</button>
        </form>
    </div>
@endsection
