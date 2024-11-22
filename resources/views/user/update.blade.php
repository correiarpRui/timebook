@extends('layouts.layout')

@section('content')
    <div class="py-10 px-5">
        <div>
            Update User
        </div>
        <form action="{{ route('user.patch', $user->id) }}" method="POST" class="flex flex-col gap-2">
            @csrf
            @method('PATCH')
            <label for="name">Name</label>
            <input type="text" name="name" value="{{ $user->name }}">
            @error('name')
                <div class="text-red-600">{{ $message }}</div>
            @enderror

            <label for="email">Email</label>
            <input type="email" name="email" value="{{ $user->email }}">
            @error('email')
                <div class="text-red-600">{{ $message }}</div>
            @enderror

            <label for="birth_date">Date of birth</label>
            <input type="date" name="birth_date" value="{{ $user->birth_date }}">
            @error('birth_date')
                <div class="text-red-600">{{ $message }}</div>
            @enderror

            <label for="role_id">User Role</label>
            <select name="role_id" id="role_id">
                @foreach ($roles as $role)
                    @if ($role->id == $user->role_id)
                        <option value="{{ $role->id }}" selected>{{ $role->role }}</option>
                    @else
                        <option value="{{ $role->id }}">{{ $role->role }}</option>
                    @endif
                @endforeach
            </select>
            @error('role_id')
                <div class="text-red-600">{{ $message }}</div>
            @enderror

            <label for="schedule_id">User Schedule</label>
            <select name="schedule_id" id="schedule_id">
                <option value="{{ 0 }}">No schedule</option>
                @foreach ($schedules as $schedule)
                    @if ($schedule->id == $user->schedule_id)
                        <option value="{{ $schedule->id }}" selected> {{ $schedule->name }} </option>
                    @else
                        <option value="{{ $schedule->id }}"> {{ $schedule->name }} </option>
                    @endif
                @endforeach
            </select>
            @error('schedule_id')
                <div class="text-red-600">{{ $message }}</div>
            @enderror

            <button class="bg-orange-400 rounded-md">Update</button>
        </form>
    </div>
@endsection
