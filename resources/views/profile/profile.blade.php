@extends('layouts.testlayout')

@section('content')
    <div class="p-6">
        <div class=" border rounded-md bg-white mb-6">
            <div class="border-b">
                <p class="p-5 font-semibold text-lg">User information</p>
            </div>
            <form action="{{ route('profile.patch', $user->id) }}" method="POST">
                @csrf
                @method('PATCH')
                <div class="px-5 pt-5 pb-2 flex items-center">
                    <label for="first_name" class="font-semibold mr-2 min-w-[150px]">First name</label>
                    <div class="flex flex-col grow">
                        <input
                            class="bg-transparent text-[#6b6f80] border border-[#e2e4ef] rounded-md h-9 px-3 py-1 focus:outline-none focus:border-[#9aa0ac] w-full"
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
                </div>

                <div class="px-5 py-2 flex items-center">
                    <label for="last_name" class="font-semibold mr-2 min-w-[150px]">Last name</label>
                    <div class="flex flex-col grow">
                        <input
                            class="bg-transparent text-[#6b6f80] border border-[#e2e4ef] rounded-md h-9 px-3 py-1 focus:outline-none focus:border-[#9aa0ac] w-full"
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
                </div>
                <div class="px-5 py-2 flex items-center">
                    <label for="email" class="font-semibold mr-2 min-w-[150px]">Email</label>
                    <div class="flex flex-col grow">
                        <input
                            class="bg-transparent text-[#6b6f80] border border-[#e2e4ef] rounded-md h-9 px-3 py-1 focus:outline-none focus:border-[#9aa0ac] w-full"
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
                </div>
                <div class="px-5 py-2 flex items-center">
                    <label for="birth_date" class="font-semibold mr-2 min-w-[150px]">Date of birth</label>
                    <div class="flex flex-col grow">
                        <input
                            class="bg-transparent text-[#6b6f80] border border-[#e2e4ef] rounded-md h-9 px-3 py-1 focus:outline-none focus:border-[#9aa0ac] w-full"
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
                </div>
                <button
                    class="bg-[#ff7f31] font-semibold rounded-md h-9 mx-5 mt-3 mb-5 px-6 text-white tracking-wider">Update
                    profile
                </button>
            </form>
        </div>
        <div class=" border rounded-md bg-white">
            <div class="border-b">
                <p class="p-5 font-semibold text-lg">Security</p>
            </div>
            <div>
                <form action="{{ route('profile.patch.password', $user->id) }}" method="POST">
                    @csrf
                    @method('PATCH')
                    <div class="px-5 pt-5 pb-2 flex items-center">
                        <label for="current_password" class="font-semibold mr-2 min-w-[150px]">Current password</label>
                        <div class="flex flex-col grow">
                            <input
                                class="bg-transparent text-[#6b6f80] border border-[#e2e4ef] rounded-md h-9 px-3 py-1 focus:outline-none focus:border-[#9aa0ac] w-full"
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
                    </div>
                    <div class="px-5 pt-5 pb-2 flex items-center">
                        <label for="password" class="font-semibold mr-2 min-w-[150px]">New password</label>
                        <div class="flex flex-col grow">
                            <input
                                class="bg-transparent text-[#6b6f80] border border-[#e2e4ef] rounded-md h-9 px-3 py-1 focus:outline-none focus:border-[#9aa0ac] w-full"
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
                    </div>
                    <button
                        class="bg-[#ff7f31] font-semibold rounded-md h-9 mx-5 mt-3 mb-5 px-6 text-white tracking-wider">Update
                        password
                    </button>
                </form>
            </div>
        </div>
    </div>
@endsection
