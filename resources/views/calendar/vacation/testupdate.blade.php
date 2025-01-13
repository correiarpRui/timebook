@extends('layouts.testlayout')

@section('content')
    <div class="p-6">
        <div class="flex items-center gap-1">
            <a href="{{ route('calendar.vacation', $event->year) }}" class="text-[#a1a1aa] hover:text-[#454e60]">Vacations</a>
            <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 21 21" fill="none"
                stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                class="lucide lucide-chevron-right text-[#a1a1aa]">
                <path d="m9 18 6-6-6-6"></path>
            </svg>
            <a href="{{ route('calendar.vacation.update', $event->id) }}">Update vacation</a>
        </div>
        <form action="{{ route('calendar.vacation.patch', $event->id) }}" method="POST">
            @csrf
            @method('PATCH')
            <div class=" border rounded-md bg-white mt-6">
                <div class="border-b flex justify-between p-5 items-center">
                    <p class="font-semibold text-lg">Vacation information</p>
                </div>
                <div class="py-2 flex flex-col gap-5">
                    <div class="px-5 mt-2 flex items-center">
                        <label for="year" class="font-semibold mr-2 min-w-[150px] py-[6px] self-start">Year</label>
                        <div class="flex flex-col grow">
                            <div
                                class="bg-transparent text-[#6b6f80] border border-[#e2e4ef] rounded-md h-[42px] px-3 py-1 focus:outline-none focus:border-[#9aa0ac] w-full">
                                {{ $event->year }}
                            </div>
                        </div>
                    </div>
                    <div class="px-5 flex items-center">
                        <label for="last_name" class="font-semibold mr-2 min-w-[150px] py-[6px] self-start">Month</label>
                        <div class="flex flex-col grow">
                            <div
                                class="bg-transparent text-[#6b6f80] border border-[#e2e4ef] rounded-md h-[42px] px-3 py-1 focus:outline-none focus:border-[#9aa0ac] w-full">
                                {{ $month['name'] }}
                            </div>
                        </div>
                    </div>
                    <div class="px-5 flex items-center">
                        <div class="font-semibold mr-2 min-w-[150px] py-[6px] self-start">Start day</div>
                        <div class="flex flex-col grow">
                            <div class="flex flex-col grow relative">
                                <button type="button"
                                    class="flex items-center justify-between bg-transparent text-[#6b6f80] border border-[#e2e4ef] rounded-md h-[42px] px-3 py-1 focus:outline-none focus:border-[#9aa0ac]"
                                    onclick="toggle_start_day_menu(this)">
                                    <span id="button_start_day_label">
                                        {{ $event->start_day }}
                                    </span>
                                    <svg class="flex-shrink-0" xmlns="http://www.w3.org/2000/svg" width="16"
                                        height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                        stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                                        class="lucide lucide-chevron-down text-muted-foreground">
                                        <path d="m6 9 6 6 6-6"></path>
                                    </svg>
                                </button>
                                <div class="select_start_day_menu grid absolute bg-white">
                                    <div class="overflow-hidden">
                                        <div class="grid grid-cols-5 p-1 w-[200px]">
                                            @for ($i = 1; $i <= $month['days']; $i++)
                                                <div
                                                    class='flex items-center text-center text-[#6b6f80] hover:bg-[#eff0f6] px-1 rounded-md'>
                                                    <input type='radio' name='start_day'
                                                        id="start_day_{{ $i }}" value="{{ $i }}"
                                                        class='peer hidden'
                                                        {{ $i == (int) $event->start_day ? 'checked' : '' }}>
                                                    <label for="start_day_{{ $i }}" id="start_day"
                                                        class='w-[28px] cursor-pointer py-1 select-none'
                                                        onclick=get_start_day(this)>{{ $i }}</label>
                                                </div>
                                            @endfor
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div>
                                @error('start_day')
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
                    <div class="px-5 mb-2 flex items-center">
                        <div class="font-semibold mr-2 min-w-[150px] py-[6px] self-start">End day</div>
                        <div class="flex flex-col grow">
                            <div class="flex flex-col grow relative">
                                <button type="button"
                                    class="flex items-center justify-between bg-transparent text-[#6b6f80] border border-[#e2e4ef] rounded-md h-[42px] px-3 py-1 focus:outline-none focus:border-[#9aa0ac]"
                                    onclick="toggle_end_day_menu(this)">
                                    <span id="button_end_day_label">
                                        {{ $event->end_day }}
                                    </span>
                                    <svg class="flex-shrink-0" xmlns="http://www.w3.org/2000/svg" width="16"
                                        height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                        stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                                        class="lucide lucide-chevron-down text-muted-foreground">
                                        <path d="m6 9 6 6 6-6"></path>
                                    </svg>
                                </button>
                                <div class="select_end_day_menu grid absolute bg-white">
                                    <div class="overflow-hidden">
                                        <div class="grid grid-cols-5 p-1 w-[200px]">
                                            @for ($i = 1; $i <= $month['days']; $i++)
                                                <div
                                                    class='flex items-center text-center text-[#6b6f80] hover:bg-[#eff0f6] px-1 rounded-md'>
                                                    <input type='radio' name='end_day' id="end_day_{{ $i }}"
                                                        value="{{ $i }}" class='peer hidden'
                                                        {{ $i == (int) $event->end_day ? 'checked' : '' }}>
                                                    <label for="end_day_{{ $i }}" id="end_day"
                                                        class='w-[28px] cursor-pointer py-1 select-none'
                                                        onclick=get_end_day(this)>{{ $i }}</label>
                                                </div>
                                            @endfor
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div>
                                @error('end_day')
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
            </div>
            <div class="flex items-center mt-6">
                <button
                    class="hover:bg-[#ff7f31] bg-[#FF8B45] font-semibold rounded-md h-9 mx-5 mb-5 px-6 text-white tracking-wider">Update
                    vacation
                </button>
                <a href="{{ route('users') }}"
                    class="font-semibold border rounded-md h-9 mb-5 px-6 tracking-wider flex items-center bg-[#f4f5f7] border-[#CBCFD2] hover:bg-[#CBCFD2] hover:border-[#dae0e5]"><span>Cancel</span>
                </a>
            </div>
    </div>
    </form>
    </div>
    <script>
        function toggle_start_day_menu(button) {
            button.nextElementSibling.classList.toggle("show");
        }

        function toggle_end_day_menu(button) {
            button.nextElementSibling.classList.toggle("show");
        }

        function get_start_day(value) {
            button_day_label = document.getElementById("button_start_day_label")
            button_day_label.textContent = value.textContent
            button_day_label.classList.remove("text-[#9ca3af]")
            button_day_label.click()
        }

        function get_end_day(value) {
            button_day_label = document.getElementById("button_end_day_label")
            button_day_label.textContent = value.textContent
            button_day_label.classList.remove("text-[#9ca3af]")
            button_day_label.click()
        }
    </script>
@endsection
