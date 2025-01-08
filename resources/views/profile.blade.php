@extends('layouts.layout')

@section('content')
    <div class="p-6 text-[#fafafa]">
        <div class="text-2xl font-bold tracking-tight text-[#fafafa]">
            Profile
        </div>
        <hr class="my-[24px] border-[#27272a]">
        <div class="font-medium text-lg tracking-tight text-[#fafafa]">
            User information
        </div>
        <hr class="my-[12px] border-[#27272a]">
        <form action="{{ route('profile.patch', $user->id) }}" method="POST" class="flex flex-col gap-4">
            @csrf
            @method('PATCH')
            <div class="flex flex-col gap-1">
                <label for="first_name" class="text-sm font-medium">First name</label>
                <input
                    class="bg-transparent border border-[#27272a] rounded-md h-9 px-3 py-1 focus:outline-none focus:border-[#e5e7eb]"
                    type="text" name="first_name" value="{{ $user->first_name }}">
                @error('first_name')
                    <div class="flex h-[24px] text-[#dc3838] items-center justify-start text-sm gap-1 pl-2">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14"
                            class=" flex-shrink-0 w-[16px] h-[16px]">
                            <path fill="#dc3838" fill-rule="evenodd"
                                d="M13.4 7A6.4 6.4 0 1 1 .6 7a6.4 6.4 0 0 1 12.8 0Zm-5.6 3.2a.8.8 0 1 1-1.6 0 .8.8 0 0 1 1.6 0ZM7 3a.8.8 0 0 0-.8.8V7a.8.8 0 0 0 1.6 0V3.8A.8.8 0 0 0 7 3Z"
                                clip-rule="evenodd"></path>
                        </svg>
                        <span>{{ $message }}</span>
                    </div>
                @enderror
            </div>
            <div class="flex flex-col gap-1">
                <label for="last_name" class="text-sm font-medium">Last name</label>
                <input
                    class="bg-transparent border border-[#27272a] rounded-md h-9 px-3 py-1 focus:outline-none focus:border-[#e5e7eb]"
                    type="text" name="last_name" value="{{ $user->last_name }}">
                @error('last_name')
                    <div class="flex h-[24px] text-[#dc3838] items-center justify-start text-sm gap-1 pl-2">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14"
                            class=" flex-shrink-0 w-[16px] h-[16px]">
                            <path fill="#dc3838" fill-rule="evenodd"
                                d="M13.4 7A6.4 6.4 0 1 1 .6 7a6.4 6.4 0 0 1 12.8 0Zm-5.6 3.2a.8.8 0 1 1-1.6 0 .8.8 0 0 1 1.6 0ZM7 3a.8.8 0 0 0-.8.8V7a.8.8 0 0 0 1.6 0V3.8A.8.8 0 0 0 7 3Z"
                                clip-rule="evenodd"></path>
                        </svg>
                        <span>{{ $message }}</span>
                    </div>
                @enderror
            </div>
            <div class="flex flex-col gap-1">
                <label for="email" class="text-sm font-medium">Email</label>
                <input
                    class="bg-transparent border border-[#27272a] rounded-md h-9 px-3 py-1 focus:outline-none focus:border-[#e5e7eb]"
                    type="email" name="email" value="{{ $user->email }}">
                @error('email')
                    <div class="flex h-[24px] text-[#dc3838] items-center justify-start text-sm gap-1 pl-2">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14"
                            class=" flex-shrink-0 w-[16px] h-[16px]">
                            <path fill="#dc3838" fill-rule="evenodd"
                                d="M13.4 7A6.4 6.4 0 1 1 .6 7a6.4 6.4 0 0 1 12.8 0Zm-5.6 3.2a.8.8 0 1 1-1.6 0 .8.8 0 0 1 1.6 0ZM7 3a.8.8 0 0 0-.8.8V7a.8.8 0 0 0 1.6 0V3.8A.8.8 0 0 0 7 3Z"
                                clip-rule="evenodd"></path>
                        </svg>
                        <span>{{ $message }}</span>
                    </div>
                @enderror
            </div>
            <div class="flex flex-col gap-1">
                <label for="birth_date" class="text-sm font-medium">Date of birth</label>
                <input
                    class="bg-transparent border border-[#27272a] rounded-md h-9 px-3 py-1 focus:outline-none focus:border-[#e5e7eb]"
                    type="date" name="birth_date" value="{{ $user->birth_date }}">
                @error('birth_date')
                    <div class="flex h-[24px] text-[#dc3838] items-center justify-start text-sm gap-1 pl-2">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14"
                            class=" flex-shrink-0 w-[16px] h-[16px]">
                            <path fill="#dc3838" fill-rule="evenodd"
                                d="M13.4 7A6.4 6.4 0 1 1 .6 7a6.4 6.4 0 0 1 12.8 0Zm-5.6 3.2a.8.8 0 1 1-1.6 0 .8.8 0 0 1 1.6 0ZM7 3a.8.8 0 0 0-.8.8V7a.8.8 0 0 0 1.6 0V3.8A.8.8 0 0 0 7 3Z"
                                clip-rule="evenodd"></path>
                        </svg>
                        <span>{{ $message }}</span>
                    </div>
                @enderror
            </div>
            <button class="bg-[#fafafa] text-[#09090b] font-medium rounded-md h-9 mr-auto mt-2 px-6 text-sm">Update
                profile</button>
        </form>

        <div class="font-medium tracking-tight text-[#fafafa] mt-[48px] text-lg">
            Security
        </div>
        <hr class="my-[12px] border-[#27272a]">
        <form action="{{ route('profile.patch.password', $user->id) }}" method="POST" class="flex flex-col gap-4">
            @csrf
            @method('PATCH')
            <div class="flex flex-col gap-1">
                <label for="current_password" class="text-sm font-medium">Current password</label>
                <input
                    class="bg-transparent border border-[#27272a] rounded-md h-9 px-3 py-1 focus:outline-none focus:border-[#e5e7eb]"
                    type="password" name="current_password">
                @error('current_password')
                    <div class="flex h-[24px] text-[#dc3838] items-center justify-start text-sm gap-1 pl-2">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14"
                            class=" flex-shrink-0 w-[16px] h-[16px]">
                            <path fill="#dc3838" fill-rule="evenodd"
                                d="M13.4 7A6.4 6.4 0 1 1 .6 7a6.4 6.4 0 0 1 12.8 0Zm-5.6 3.2a.8.8 0 1 1-1.6 0 .8.8 0 0 1 1.6 0ZM7 3a.8.8 0 0 0-.8.8V7a.8.8 0 0 0 1.6 0V3.8A.8.8 0 0 0 7 3Z"
                                clip-rule="evenodd"></path>
                        </svg>
                        <span>{{ $message }}</span>
                    </div>
                @enderror
            </div>
            <div class="flex flex-col gap-1">
                <label for="password" class="text-sm font-medium">New password</label>
                <input
                    class="bg-transparent border border-[#27272a] rounded-md h-9 px-3 py-1 focus:outline-none focus:border-[#e5e7eb]"
                    type="password" name="password">
                @error('password')
                    <div class="flex h-[24px] text-[#dc3838] items-center justify-start text-sm gap-1 pl-2">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14"
                            class=" flex-shrink-0 w-[16px] h-[16px]">
                            <path fill="#dc3838" fill-rule="evenodd"
                                d="M13.4 7A6.4 6.4 0 1 1 .6 7a6.4 6.4 0 0 1 12.8 0Zm-5.6 3.2a.8.8 0 1 1-1.6 0 .8.8 0 0 1 1.6 0ZM7 3a.8.8 0 0 0-.8.8V7a.8.8 0 0 0 1.6 0V3.8A.8.8 0 0 0 7 3Z"
                                clip-rule="evenodd"></path>
                        </svg>
                        <span>{{ $message }}</span>
                    </div>
                @enderror
            </div>
            <button class="bg-[#fafafa] text-[#09090b] font-medium rounded-md h-9 mr-auto mt-2 px-6 text-sm">Update
                password</button>
        </form>

    </div>
@endsection
