@extends('layouts.layout')

@section('content')
    <div class="py-10 px-5">
        <div>
            Create New Record
        </div>
        <form action="/record" method="POST" class="flex flex-col gap-2">
            @csrf
            <label for="user">User name</label>
            <select name="user_id" id="user">
                <option disabled selected>Select user</option>
                @foreach ($users as $user)
                    <option value="{{ $user->id }}"> {{ $user->first_name }} {{ $user->last_name }} </option>
                @endforeach
            </select>
            <button class="bg-orange-400 rounded-md">Submit</button>
        </form>
    </div>
@endsection
