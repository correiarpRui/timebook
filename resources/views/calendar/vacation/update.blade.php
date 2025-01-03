@extends('layouts.layout')

@section('content')
    <div class="text-[#fafafa]">
        <ol class="flex items-center p-2 gap-1">
            <li>
                <a href="{{ route('calendar.vacation', $event->year) }}"
                    class="text-[#a1a1aa] hover:text-[#fafafa]">Vacation</a>
            </li>
            <li>
                <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 21 21" fill="none"
                    stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                    class="lucide lucide-chevron-right text-[#a1a1aa]">
                    <path d="m9 18 6-6-6-6"></path>
                </svg>
            </li>
            <li>
                <a href="{{ route('calendar.vacation.update', $event->id) }}">Update vacation</a>
            </li>
        </ol>
        <div class="p-6">
            <div class="text-2xl font-bold tracking-tight text-[#fafafa]">
                Update Vacation
            </div>
            <hr class="my-[12px] border-[#27272a]">
            <form action="{{ route('calendar.vacation.patch', $event->id) }}" method="POST" class="flex flex-col gap-4">
                @csrf
                @method('PATCH')
                <div class="flex flex-col gap-1">
                    <label for="year" class="text-sm font-medium ">Year</label>
                    <div class="bg-transparent border border-[#27272a] rounded-md h-9 px-3 py-1 text-[#9ca3af]">
                        {{ $event->year }}
                    </div>
                </div>
                <div class="flex flex-col gap-1">
                    <label for="year" class="text-sm font-medium">Month</label>
                    <div class="bg-transparent border border-[#27272a] rounded-md h-9 px-3 py-1 text-[#9ca3af]">
                        {{ $month['name'] }}
                    </div>
                </div>
                <div class="flex flex-col gap-1">
                    <label for="year" class="text-sm font-medium">Start day</label>
                    <div class="flex flex-col">
                        <button
                            class="bg-transparent border border-[#27272a] rounded-md h-9 px-3 flex justify-between items-center"
                            type="button" onclick=toggleSubMenuDropDown(this)>
                            <span id="button_start_day">{{ (int) $event->start_day }}</span>
                            <svg class="flex-shrink-0" xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                stroke-linecap="round" stroke-linejoin="round"
                                class="lucide lucide-chevron-down text-muted-foreground">
                                <path d="m6 9 6 6 6-6"></path>
                            </svg>
                        </button>
                        <div class="bg-transparent rounded-md px-1 grid submenu_options w-[230px]">
                            <div class="overflow-hidden grid grid-cols-5">
                                @for ($i = 1; $i <= $month['days']; $i++)
                                    <div class="flex items-center text-center hover:bg-[#27272a] px-3 rounded-md">
                                        <input type='radio' name='start_day' id="start_day_{{ $i }}"
                                            value="{{ $i }}" class='peer hidden'
                                            {{ $i == (int) $event->start_day ? 'checked' : '' }}>
                                        <label for="start_day_{{ $i }}" id="start_day"
                                            class='grow cursor-pointer py-1 select-none'
                                            onclick=get_day(this)>{{ $i }}</label>
                                    </div>
                                @endfor
                            </div>
                        </div>
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

                <div class="flex flex-col gap-1">
                    <label for="year" class="text-sm font-medium">End day</label>
                    <div class="flex flex-col">
                        <button
                            class="bg-transparent border border-[#27272a] rounded-md h-9 px-3 flex justify-between items-center"
                            type="button" onclick=toggleSubMenuDropDown(this)>
                            <span id="button_end_day">{{ $event->end_day }}</span>
                            <svg class="flex-shrink-0" xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                stroke-linecap="round" stroke-linejoin="round"
                                class="lucide lucide-chevron-down text-muted-foreground">
                                <path d="m6 9 6 6 6-6"></path>
                            </svg>
                        </button>
                        <div class="bg-transparent rounded-md px-1 grid submenu_options w-[230px]">
                            <div class="overflow-hidden grid grid-cols-5">
                                @for ($i = 1; $i <= $month['days']; $i++)
                                    <div class="flex items-center text-center hover:bg-[#27272a] px-3 rounded-md">
                                        <input type='radio' name='end_day' id="end_day_{{ $i }}"
                                            value="{{ $i }}" class='peer hidden'
                                            {{ $i == (int) $event->end_day ? 'checked' : '' }}>
                                        <label for="end_day_{{ $i }}" id="end_day"
                                            class='grow cursor-pointer py-1 select-none'
                                            onclick=get_day(this)>{{ $i }}</label>
                                    </div>
                                @endfor
                            </div>
                        </div>
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
                <button class="bg-[#fafafa] text-[#09090b] font-medium rounded-md h-9 mr-auto mt-2 px-6">Update</button>
            </form>
        </div>
    </div>

    <script>
        function get_day(value) {
            console.log("button_" + value.id)
            button_day_label = document.getElementById("button_" + value.id)
            button_day_label.textContent = value.textContent
            button_day_label.click()
        }
    </script>
@endsection
