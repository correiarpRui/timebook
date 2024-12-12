@extends('layouts.layout')

@section('content')
    <div class="text-[#fafafa] p-6">
        <div class="flex justify-between">
            <div class="text-2xl font-bold tracking-tight text-[#fafafa]">Schedule Planner {{ $year }}</div>
            <div class="flex gap-3">
                <a class="bg-[#fafafa] text-[#09090b] flex items-center gap-2 rounded-md px-4 py-2 cursor-pointer text-sm font-medium"
                    href="{{ route('schedule.planner', $year - 1) }}">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none"
                        stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                        class="lucide lucide-chevron-left">
                        <path d="m15 18-6-6 6-6" />
                    </svg>
                </a>
                <a class="bg-[#fafafa] text-[#09090b] flex items-center gap-2 rounded-md px-4 py-2 cursor-pointer text-sm font-medium"
                    href="{{ route('schedule.planner', $year + 1) }}">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none"
                        stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                        class="lucide lucide-chevron-right">
                        <path d="m9 18 6-6-6-6" />
                    </svg>
                </a>
            </div>
        </div>
        <hr class="my-[24px] border-[#27272a]">

        <div class="grid m-auto w-fit">
            <form action="{{ route('schedule.planner.store') }}" method="POST">
                @csrf
                @foreach ($weeks as $key => $month)
                    <div class="flex p-2">
                        <div class="p-6 pt-3 border-y border border-[#27272a] rounded-lg">
                            <div class="p-2 text-center font-semibold text-2xl pb-3"> {{ $key }}</div>
                            <div class="grid grid-cols-7 border-y border-[#27272a] text-center">
                                <div class="p-1 text-[#a1a1aa]">Su</div>
                                <div class="p-1 text-[#a1a1aa]">Mo</div>
                                <div class="p-1 text-[#a1a1aa]">Tu</div>
                                <div class="p-1 text-[#a1a1aa]">We</div>
                                <div class="p-1 text-[#a1a1aa]">Th</div>
                                <div class="p-1 text-[#a1a1aa]">Fr</div>
                                <div class="p-1 text-[#a1a1aa]">Sa</div>
                            </div>
                            @foreach ($month as $week)
                                <div
                                    class="grid grid-cols-7 text-center border-b border-[#27272a] last:border-none relative">
                                    @foreach ($week as $day)
                                        <div class="w-16 h-10 inline-flex items-end justify-center">
                                            {{ $day['day'] }}</div>
                                    @endforeach
                                    <div class="h-10">
                                        &nbsp
                                    </div>

                                    <div class="absolute  w-full flex flex-col bottom-3">
                                        <button
                                            class=" bg-[#27272a] bg-opacity-30 border border-[#27272a] rounded-md text-xs py-[2px] px-3 hover:bg-[#27272a] flex justify-between items-center"
                                            type="button" onclick=toggleSubMenuDropDown(this)>
                                            <span id="button{{ $week->last()['id'] }}">Select schedule</span>
                                            <svg class="flex-shrink-0" xmlns="http://www.w3.org/2000/svg" width="16"
                                                height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                                stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                                                class="lucide lucide-chevron-down text-muted-foreground">
                                                <path d="m6 9 6 6 6-6"></path>
                                            </svg>
                                        </button>
                                        <div
                                            class="rounded-md px-1 grid submenu_options absolute top-5 bg-[#27272a] w-full z-10">
                                            <div class="overflow-hidden">
                                                @foreach ($schedule_list as $schedule)
                                                    <div
                                                        class="flex items-center justify-start hover:bg-[#27272a] px-3 rounded-md">
                                                        <input type="radio" name="{{ $week->last()['id'] }}"
                                                            id="{{ $week->last()['id'] }}{{ $schedule->id }}"
                                                            value="{{ $schedule->id }}" class="peer hidden">
                                                        <label for="{{ $week->last()['id'] }}{{ $schedule->id }}"
                                                            id="{{ $week->last()['id'] }}"
                                                            class="cursor-pointer py-1 mr-auto select-none"
                                                            onclick=get_role_name(this)>{{ $schedule->name }}</label>
                                                        <svg xmlns="http://www.w3.org/2000/svg" width="16"
                                                            height="16" viewBox="0 0 24 24" fill="none"
                                                            stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                                            stroke-linejoin="round"
                                                            class="lucide lucide-check mr-2 opacity-100  hidden peer-checked:block">
                                                            <path d="M20 6 9 17l-5-5"></path>
                                                        </svg>
                                                    </div>
                                                @endforeach
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                            <button type="submit">Submit</button>
                        </div>
                    </div>
                @endforeach
            </form>
        </div>
    </div>

    <script>
        function get_role_name(value) {
            button_role_label = document.getElementById(`button${value.id}`)
            button_role_label.textContent = value.textContent
            button_role_label.click()
        }
    </script>
@endsection
