@extends('layouts.layout')

@section('content')
    <div class="py-10 px-5">
        <div>
            Update Record
        </div>
        <form action="{{ route('record.patch', $record[0]->id) }}" method="POST" class="flex flex-col gap-2">
            @csrf
            @method('PATCH')
            <label for="date">Date</label>
            <input type="text" name="date" value="{{ $record[0]->date }}" disabled>

            <label for="week_day">Week Day</label>
            <input type="text" name="week_day" value="{{ $record[0]->week_day }}" disabled>

            <label for="username">User name</label>
            <input type="text" name="username" value="{{ $record[0]->user->name }}" disabled>

            <label for="morning_start">Morning Start</label>
            <input type="time" name="morning_start" value="{{ $record[0]->morning_start }}">
            @error('morning_start')
                <div class="text-red-600">{{ $message }}</div>
            @enderror

            <label for="morning_end">Morning End</label>
            <input type="time" name="morning_end" value="{{ $record[0]->morning_end }}">
            @error('morning_end')
                <div class="text-red-600">{{ $message }}</div>
            @enderror

            <label for="afternoon_start">Afternoon Start</label>
            <input type="time" name="afternoon_start" value="{{ $record[0]->afternoon_start }}">
            @error('afternoon_start')
                <div class="text-red-600">{{ $message }}</div>
            @enderror

            <label for="afternoon_end">Afternoon End</label>
            <input type="time" name="afternoon_end" value="{{ $record[0]->afternoon_end }}">
            @error('afternoon_end')
                <div class="text-red-600">{{ $message }}</div>
            @enderror
            <div>
                <label for="is_present">Present</label>
                <input type="checkbox" name="is_present" id="is_present" {{ $record[0]->is_present ? 'checked' : '' }}>
            </div>

            <button class="bg-orange-400 rounded-md">Update</button>
        </form>
    </div>
@endsection
