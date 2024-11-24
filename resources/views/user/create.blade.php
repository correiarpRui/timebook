@extends('layouts.layout')

@section('content')
    <div class="text-[#fafafa]">
        <ol class="flex items-center p-2 gap-1">
            <li>
                <a href="{{ route('users') }}" class="text-[#a1a1aa] hover:text-[#fafafa]">Users</a>
            </li>
            <li>
                <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 21 21" fill="none"
                    stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                    class="lucide lucide-chevron-right text-[#a1a1aa]">
                    <path d="m9 18 6-6-6-6"></path>
                </svg>
            </li>
            <li>
                <a href="{{ route('user.create') }}">Create user</a>
            </li>
        </ol>
        <div class="p-6">
            <div class="text-2xl font-bold tracking-tight text-[#fafafa]">
                Create User
            </div>
            <hr class="my-[24px] border-[#27272a]">
            <form action="/user" method="POST" class="flex flex-col gap-4">
                @csrf
                <div class="flex flex-col gap-1">
                    <label for="name" class="text-sm font-medium">Name</label>
                    <input
                        class="bg-transparent border border-[#27272a] rounded-md h-9 px-3 py-1 focus:outline-none focus:border-[#e5e7eb]"
                        type="text" name="name" value="{{ old('name') }}">
                    @error('name')
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
                        type="email" name="email" value="{{ old('email') }}">
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
                        type="date" name="birth_date" value="{{ old('birth_date') }}">
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

                <div class="flex flex-col gap-1">
                    <label for="role_id" class="text-sm font-medium">User Role</label>
                    <div class="flex flex-col">
                        <button
                            class="bg-transparent border border-[#27272a] rounded-md h-9 px-3 flex justify-between items-center"
                            type="button" onclick=toggleSubMenuDropDown(this)>
                            <span id="button_role_label">Select role</span>
                            <svg class="flex-shrink-0" xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                stroke-linecap="round" stroke-linejoin="round"
                                class="lucide lucide-chevron-down text-muted-foreground">
                                <path d="m6 9 6 6 6-6"></path>
                            </svg>
                        </button>
                        <div class="bg-transparent rounded-md px-1 grid submenu_options">
                            <div class="overflow-hidden">
                                @foreach ($roles as $role)
                                    <div class="flex items-center hover:bg-[#27272a] px-3 rounded-md">
                                        <input type="radio" name="role_id" id="role{{ $role->id }}"
                                            value="{{ $role->id }}" class="peer hidden">
                                        <label for="role{{ $role->id }}" class="grow cursor-pointer py-1 select-none"
                                            onclick=get_role_name(this)>{{ $role->role }}</label>
                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                            viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                            stroke-linecap="round" stroke-linejoin="round"
                                            class="lucide lucide-check mr-2 opacity-100 m-auto hidden peer-checked:block">
                                            <path d="M20 6 9 17l-5-5"></path>
                                        </svg>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                        @error('role_id')
                            <div class="flex h-[24px] text-[#dc3838] items-center justify-start text-sm gap-1 py-2 pl-2">
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

                <div class="flex flex-col gap-1">
                    <label for="schedule_id" class="text-sm font-medium">User Schedule</label>
                    <div class="flex flex-col">
                        <button
                            class="bg-transparent border border-[#27272a] rounded-md h-9 px-3 flex justify-between items-center"
                            type="button" onclick=toggleSubMenuDropDown(this)>
                            <span id="button_schedule_label">Select schedule</span>
                            <svg class="flex-shrink-0" xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                stroke-linecap="round" stroke-linejoin="round"
                                class="lucide lucide-chevron-down text-muted-foreground">
                                <path d="m6 9 6 6 6-6"></path>
                            </svg>
                        </button>
                        <div class="bg-transparent rounded-md px-1 grid submenu_options">
                            <div class="overflow-hidden">
                                <div class="flex items-center hover:bg-[#27272a] px-3 rounded-md">
                                    <input type="radio" name="schedule_id" id="0" value="0"
                                        class="peer hidden">
                                    <label for="0" class="grow cursor-pointer py-1 select-none"
                                        onclick=get_schedule_name(this)>No schedule</label>
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                        viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                        stroke-linecap="round" stroke-linejoin="round"
                                        class="lucide lucide-check mr-2 opacity-100 m-auto hidden peer-checked:block">
                                        <path d="M20 6 9 17l-5-5"></path>
                                    </svg>
                                </div>
                                @foreach ($schedules as $schedule)
                                    <div class="flex items-center hover:bg-[#27272a] px-3 rounded-md">
                                        <input type="radio" name="schedule_id" id="schedule{{ $schedule->id }}"
                                            value="{{ $schedule->id }}" class="peer hidden">
                                        <label for="schedule{{ $schedule->id }}"
                                            class="grow cursor-pointer py-1 select-none"
                                            onclick=get_schedule_name(this)>{{ $schedule->name }}</label>
                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                            viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                            stroke-linecap="round" stroke-linejoin="round"
                                            class="lucide lucide-check mr-2 opacity-100 m-auto hidden peer-checked:block">
                                            <path d="M20 6 9 17l-5-5"></path>
                                        </svg>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                        @error('schedule_id')
                            <div class="flex h-[24px] text-[#dc3838] items-center justify-start text-sm gap-1 py-2 pl-2">
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
                <div class="flex flex-col gap-1">
                    <label for="password" class="text-sm font-medium">Password</label>
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
                <button class="bg-[#fafafa] text-[#09090b] font-medium rounded-md h-9 mr-auto mt-2 px-6">Submit</button>

            </form>
        </div>
    </div>

    <script>
        function get_role_name(value) {
            button_role_label = document.getElementById("button_role_label")
            button_role_label.textContent = value.textContent
            button_role_label.click()
            console.log(value.textContent)
        }

        function get_schedule_name(value) {
            button_schedule_label = document.getElementById("button_schedule_label")
            button_schedule_label.textContent = value.textContent
            button_schedule_label.click()
            console.log(value.textContent)
        }
    </script>
@endsection
