@extends('layouts.layout')

@section('content')
    <div class="py-10 px-5 w-full">
        <div class="uppercase text-2xl font-semibold ">Profile</div>
        <hr class="border-black border-[1px] mt-1 mb-5">

        <div class="uppercase text-xl font-semibold">User Information</div>
        <form action="{{ route('profile.patch', $user->id) }}" method="POST">
            @csrf
            @method('patch')
            <div class="flex flex-col">
                <label for="name">Name</label>
                <input class="text-lg p-2" type="text" value="{{ $user->name }}" name="name">
                @error('name')
                    <div class="text-red-600">{{ $message }}</div>
                @enderror
            </div>
            <div class="flex flex-col">
                <label for="name">Email</label>
                <input class="text-lg p-2" type="email" value="{{ $user->email }}" name="email">
                @error('email')
                    <div class="text-red-600">{{ $message }}</div>
                @enderror
            </div>
            <button class="uppercase bg-orange-400 rounded-md px-8 py-1 my-5">Update</button>
        </form>

        <div class="uppercase text-xl font-semibold">Security</div>
        <form action="{{ route('profile.patch.password', $user->id) }}" method="POST">
            @csrf
            @method('patch')
            <div class="flex flex-col">
                <label for="curent_password">Current password</label>
                <input class="text-lg p-2" type="password" name="current_password">
                @error('current_password')
                    <div class="text-red-600">{{ $message }}</div>
                @enderror
            </div>
            <div class="flex flex-col">
                <label for="password">New password</label>
                <input class="text-lg p-2" type="password" name="password">
                @error('password')
                    <div class="text-red-600">{{ $message }}</div>
                @enderror
            </div>
            <button class="uppercase bg-orange-400 rounded-md px-8 py-1 my-5">Update</button>
        </form>


    </div>
@endsection
