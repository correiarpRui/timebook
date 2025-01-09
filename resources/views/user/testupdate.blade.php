@extends('layouts.testlayout')
@section('content')
    <div class="p-6">
        <div class="flex items-center gap-1">
            <a href="{{ route('users') }}" class="text-[#a1a1aa] hover:text-[#454e60]">Users</a>
            <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 21 21" fill="none"
                stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                class="lucide lucide-chevron-right text-[#a1a1aa]">
                <path d="m9 18 6-6-6-6"></path>
            </svg>
            <a href="{{ route('user.update', $user->id) }}">Update user</a>
        </div>
        <form action="{{ route('user.patch', $user->id) }}" method="POST">
            @csrf
            @method('PATCH')
            <div class=" border rounded-md bg-white mt-6">
                <div class="border-b flex justify-between p-5 items-center">
                    <p class="font-semibold text-lg">User information</p>
                </div>
                <div class="py-2 flex flex-col gap-5">
                    <div class="px-5 mt-2 flex items-center">
                        <label for="first_name" class="font-semibold mr-2 min-w-[150px] py-[6px] self-start">First
                            name</label>
                        <div class="flex flex-col grow">
                            <input
                                class="bg-transparent text-[#6b6f80] border border-[#e2e4ef] rounded-md h-[42px] px-3 py-1 focus:outline-none focus:border-[#9aa0ac] w-full"
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
                    <div class="px-5 flex items-center">
                        <label for="last_name" class="font-semibold mr-2 min-w-[150px] py-[6px] self-start">Last
                            name</label>
                        <div class="flex flex-col grow">
                            <input
                                class="bg-transparent text-[#6b6f80] border border-[#e2e4ef] rounded-md h-[42px] px-3 py-1 focus:outline-none focus:border-[#9aa0ac] w-full"
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
                    <div class="px-5 flex items-center">
                        <label for="email" class="font-semibold mr-2 min-w-[150px] py-[6px] self-start">Email</label>
                        <div class="flex flex-col grow">
                            <input
                                class="bg-transparent text-[#6b6f80] border border-[#e2e4ef] rounded-md h-[42px] px-3 py-1 focus:outline-none focus:border-[#9aa0ac] w-full"
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
                    <div class="px-5 flex items-center">
                        <label for="birth_date" class="font-semibold mr-2 min-w-[150px] py-[6px] self-start">Date of
                            birth</label>
                        <div class="flex flex-col grow">
                            <input
                                class="bg-transparent text-[#6b6f80] border border-[#e2e4ef] rounded-md h-[42px] px-3 py-1 focus:outline-none focus:border-[#9aa0ac] w-full"
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
                    <div class="px-5 flex items-center">
                        <label for="role_id" class="font-semibold mr-2 min-w-[150px] py-[6px] self-start">User role</label>
                        <div class="flex flex-col grow">
                            <div class="flex flex-col grow relative">
                                <button type="button"
                                    class="flex items-center justify-between bg-transparent text-[#6b6f80] border border-[#e2e4ef] rounded-md h-[42px] px-3 py-1 focus:outline-none focus:border-[#9aa0ac]"
                                    onclick="toggle_role_menu(this)">
                                    <span id="role_label">
                                        @if (old('role_id'))
                                            @foreach ($roles as $role)
                                                @if (old('role_id') == $role->id)
                                                    {{ $role->role }}
                                                @endif
                                            @endforeach
                                        @else
                                            {{ $user->role->role }}
                                        @endif
                                    </span>
                                    <svg class="flex-shrink-0" xmlns="http://www.w3.org/2000/svg" width="16"
                                        height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                        stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                                        class="lucide lucide-chevron-down text-muted-foreground">
                                        <path d="m6 9 6 6 6-6"></path>
                                    </svg>
                                </button>
                                <div class="select_role_menu grid w-full absolute bg-white">
                                    <div class="overflow-hidden">
                                        @foreach ($roles as $role)
                                            <div
                                                class="flex items-center px-3 rounded-md hover:bg-[#eff0f6] text-[#6b6f80]">
                                                <input type="radio" name="role_id" id="role{{ $role->id }}"
                                                    value="{{ $role->id }}" class="peer hidden"
                                                    @if ($role->id == $user->role_id) checked @endif>
                                                <label for="role{{ $role->id }}" class="grow cursor-pointer py-1"
                                                    onclick=get_role(this)>{{ $role->role }}</label>
                                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                                    viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                                    stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                                                    class="lucide lucide-check mr-2 opacity-100 m-auto  hidden peer-checked:block">
                                                    <path d="M20 6 9 17l-5-5"></path>
                                                </svg>
                                            </div>
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                            @error('role_id')
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
                    <div class="px-5 mb-2 flex items-center">
                        <label for="vacation_days" class="font-semibold mr-2 min-w-[150px] py-[6px] self-start">Vacation
                            days</label>
                        <div class="flex flex-col grow">
                            <input
                                class="bg-transparent text-[#6b6f80] border border-[#e2e4ef] rounded-md h-[42px] px-3 py-1 focus:outline-none focus:border-[#9aa0ac] w-full"
                                type="number" name="vacation_days"
                                value="{{ $user->vacation()->first()->vacation_days }}">
                            @error('vacation_days')
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
                </div>
            </div>
            <div class="flex items-center mt-6">
                <button
                    class="hover:bg-[#ff7f31] bg-[#FF8B45] font-semibold rounded-md h-9 mx-5 mb-5 px-6 text-white tracking-wider">Update
                    user
                </button>
                <a href="{{ route('users') }}"
                    class="font-semibold border rounded-md h-9 mb-5 px-6 tracking-wider flex items-center bg-[#f4f5f7] border-[#CBCFD2] hover:bg-[#CBCFD2] hover:border-[#dae0e5]"><span>Cancel</span>
                </a>
            </div>
        </form>
    </div>
    <script>
        function toggle_role_menu(button) {
            button.nextElementSibling.classList.toggle("show");
        }

        function get_role(role) {
            role_label = document.getElementById("role_label")
            role_label.textContent = role.textContent
            role_label.click()
        }
    </script>
@endsection
