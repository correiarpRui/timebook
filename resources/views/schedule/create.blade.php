@extends('layouts.layout')

@section('content')
    <div class="py-10 px-5">
        <div>
            Create New Schedule
        </div>
        <form action="/schedule" method="POST" class="flex flex-col gap-2">
            @csrf
            <label for="name">Name</label>
            <input type="text" name="name" value="{{ old('name') }}">
            @error('name')
                <div class="text-red-600">{{ $message }}</div>
            @enderror

            <label for="morning_start">Morning Start</label>
            <input type="time" name="morning_start">
            @error('morning_start')
                <div class="text-red-600">{{ $message }}</div>
            @enderror

            <label for="morning_end">Morning End</label>
            <input type="time" name="morning_end">
            @error('morning_end')
                <div class="text-red-600">{{ $message }}</div>
            @enderror

            <label for="afternoon_start">Afternoon Start</label>
            <input type="time" name="afternoon_start">
            @error('afternoon_start')
                <div class="text-red-600">{{ $message }}</div>
            @enderror

            <label for="afternoon_end">Afternoon End</label>
            <input type="time" name="afternoon_end">
            @error('afternoon_end')
                <div class="text-red-600">{{ $message }}</div>
            @enderror

            <fieldset>
                <legend>Work Days</legend>

                <input type="checkbox" name="monday" id="monday">
                <label for="monday">Monday</label>

                <input type="checkbox" name="tuesday" id="tuesday">
                <label for="tuesday">Tuesday</label>

                <input type="checkbox" name="wednesday" id="wednesday">
                <label for="wednesday">Wednesday</label>

                <input type="checkbox" name="thursday" id="thursday">
                <label for="thursday">Thursday</label>

                <input type="checkbox" name="friday" id="friday">
                <label for="friday">Friday</label>

                <input type="checkbox" name="saturday" id="saturday">
                <label for="saturday">Saturday</label>

                <input type="checkbox" name="sunday" id="sunday">
                <label for="sunday">Sunday</label>
            </fieldset>
            @error('monday')
                <div class="text-red-600">{{ $message }}</div>
            @enderror
            @error('tuesday')
                <div class="text-red-600">{{ $message }}</div>
            @enderror
            @error('wednesday')
                <div class="text-red-600">{{ $message }}</div>
            @enderror
            @error('thursday')
                <div class="text-red-600">{{ $message }}</div>
            @enderror
            @error('friday')
                <div class="text-red-600">{{ $message }}</div>
            @enderror
            @error('saturday')
                <div class="text-red-600">{{ $message }}</div>
            @enderror
            @error('sunday')
                <div class="text-red-600">{{ $message }}</div>
            @enderror

            <button class="bg-orange-400 rounded-md">Submit</button>
        </form>
    </div>
@endsection
