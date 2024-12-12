@extends('layouts.layout')

@section('content')
    <div class="text-[#fafafa] p-2">

        <div class="border border-[#fafafa] flex flex-col">
            <div class="border border-[#fafafa] p-2 flex justify-between items-center">
                <div class="text-xl font-semibold">Schedule planner {{ $year }}</div>
                <div class="flex gap-2">
                    <a href="" class="bg-[#fafafa] p-2 rounded-md">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24"
                            fill="none" stroke="#09090b" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                            class="lucide lucide-chevron-left">
                            <path d="m15 18-6-6 6-6" />
                        </svg>
                    </a>
                    <a href="" class="bg-[#fafafa] p-2 rounded-md">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24"
                            fill="none" stroke="#09090b" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                            class="lucide lucide-chevron-right">
                            <path d="m9 18 6-6-6-6" />
                        </svg>
                    </a>
                </div>
            </div>
            <div class="border border-[#fafafa] grid grid-cols-12 text-center">
                <a href="{{ route('schedule.planner', [date('Y'), 1]) }}"
                    class="border border-[#fafafa] @if ($month_name == 'January') bg-[#27272a] @endif">January</a>
                <a href="{{ route('schedule.planner', [date('Y'), 2]) }}"
                    class="border border-[#fafafa] @if ($month_name == 'February') bg-[#27272a] @endif">February</a>
                <a href="{{ route('schedule.planner', [date('Y'), 3]) }}"
                    class="border border-[#fafafa] @if ($month_name == 'March') bg-[#27272a] @endif">March</a>
                <a href="{{ route('schedule.planner', [date('Y'), 4]) }}"
                    class="border border-[#fafafa] @if ($month_name == 'April') bg-[#27272a] @endif">April</a>
                <a href="{{ route('schedule.planner', [date('Y'), 5]) }}"
                    class="border border-[#fafafa] @if ($month_name == 'May') bg-[#27272a] @endif">May</a>
                <a href="{{ route('schedule.planner', [date('Y'), 6]) }}"
                    class="border border-[#fafafa] @if ($month_name == 'June') bg-[#27272a] @endif">June</a>
                <a href="{{ route('schedule.planner', [date('Y'), 7]) }}"
                    class="border border-[#fafafa] @if ($month_name == 'July') bg-[#27272a] @endif">July</a>
                <a href="{{ route('schedule.planner', [date('Y'), 8]) }}"
                    class="border border-[#fafafa] @if ($month_name == 'August') bg-[#27272a] @endif">August</a>
                <a href="{{ route('schedule.planner', [date('Y'), 9]) }}"
                    class="border border-[#fafafa] @if ($month_name == 'September') bg-[#27272a] @endif">September</a>
                <a href="{{ route('schedule.planner', [date('Y'), 10]) }}"
                    class="border border-[#fafafa] @if ($month_name == 'October') bg-[#27272a] @endif">October</a>
                <a href="{{ route('schedule.planner', [date('Y'), 11]) }}"
                    class="border border-[#fafafa] @if ($month_name == 'November') bg-[#27272a] @endif">November</a>
                <a href="{{ route('schedule.planner', [date('Y'), 12]) }}"
                    class="border border-[#fafafa] @if ($month_name == 'December') bg-[#27272a] @endif">December</a>
            </div>
        </div>

        <div class="flex flex-col border border-[#fafafa]">
            <form action="{{ route('schedule.planner.store') }}" method="POST">
                @csrf
                <div class="grid grid-cols-[150px_1fr]">
                    <div class="grid grid-cols-7 text-center col-start-2">
                        <div class="p-1 text-[#a1a1aa]">Su</div>
                        <div class="p-1 text-[#a1a1aa]">Mo</div>
                        <div class="p-1 text-[#a1a1aa]">Tu</div>
                        <div class="p-1 text-[#a1a1aa]">We</div>
                        <div class="p-1 text-[#a1a1aa]">Th</div>
                        <div class="p-1 text-[#a1a1aa]">Fr</div>
                        <div class="p-1 text-[#a1a1aa]">Sa</div>
                    </div>
                </div>
                @foreach ($month as $week)
                    <div class="grid grid-cols-[150px_1fr]">
                        <div class="grid grid-cols-7 text-center col-start-2">
                            @foreach ($week as $day)
                                <div>
                                    {{ $day['day'] }}
                                </div>
                            @endforeach
                        </div>

                        <div class="grid col-span-2 mb-3">
                            <div class="grid grid-cols-[150px_1fr] gap-1">
                                @foreach ($users as $user)
                                    <div>
                                        {{ $user->first_name }} {{ $user->last_name }}
                                    </div>

                                    <div class="flex flex-col relative">
                                        <button
                                            class=" bg-[#27272a] bg-opacity-30 border border-[#27272a] rounded-md text-xs py-[2px] px-3 hover:bg-[#27272a] flex justify-between items-center"
                                            type="button" onclick=toggleSubMenuDropDown(this)>
                                            <span id="button{{ $week->last()['id'] }}-{{ $user->id }}">Select
                                                schedule</span>
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
                                                        <input type="radio"
                                                            name="{{ $week->last()['id'] }}-{{ $user->id }}"
                                                            id="{{ $week->last()['id'] }}{{ $schedule->id }}{{ $user->id }}"
                                                            value="{{ $schedule->id }}" class="peer hidden">
                                                        <label
                                                            for="{{ $week->last()['id'] }}{{ $schedule->id }}{{ $user->id }}"
                                                            id="{{ $week->last()['id'] }}-{{ $user->id }}"
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
                                @endforeach
                            </div>

                        </div>

                    </div>
                @endforeach
                <button type="submit">Submit Schedule</button>
            </form>
        </div>
    </div>
    <script>
        function get_role_name(value) {
            id = value.id

            console.log(id)
            button_role_label = document.getElementById(`button${value.id}`)
            console.log(button_role_label)
            button_role_label.textContent = value.textContent
            button_role_label.click()
        }
    </script>
@endsection
