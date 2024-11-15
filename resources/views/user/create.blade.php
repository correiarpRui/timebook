@extends('layouts.layout')

@section('content')
    <div class="py-10 px-5">
        <div>
            Create New User
        </div>
        <form action="/user" method="POST" class="flex flex-col gap-2">
            @csrf
            <label for="name">Name</label>
            <input type="text" name="name" value="{{ old('name') }}">
            @error('name')
                <div class="text-red-600">{{ $message }}</div>
            @enderror

            <label for="email">Email</label>
            <input type="email" name="email" value="{{ old('email') }}">
            @error('email')
                <div class="text-red-600">{{ $message }}</div>
            @enderror

            <label for="role_id">User Role</label>
            <select name="role_id" id="role_id">
                <option disabled selected value>Select role</option>
                @foreach ($roles as $role)
                    <option value="{{ $role->id }}">{{ $role->role }}</option>
                @endforeach
            </select>
            @error('role_id')
                <div class="text-red-600">{{ $message }}</div>
            @enderror

            <label for="schedule_id">User Schedule</label>
            <select name="schedule_id" id="schedule_id">
                <option disabled selected value>Select schedule</option>
                <option value="{{ 0 }}">No schedule</option>
                @foreach ($schedules as $schedule)
                    <option value="{{ $schedule->id }}"> {{ $schedule->name }} </option>
                @endforeach
            </select>
            @error('schedule_id')
                <div class="text-red-600">{{ $message }}</div>
            @enderror

            <label for="password">Password</label>
            <input type="password" name="password">
            @error('password')
                <div class="text-red-600">{{ $message }}</div>
            @enderror
            <button class="bg-orange-400 rounded-md">Submit</button>
        </form>
    </div>
@endsection
