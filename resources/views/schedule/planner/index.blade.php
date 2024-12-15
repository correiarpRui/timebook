@extends('layouts.layout')

@section('content')
    <div class="text-[#fafafa]">
        <div class="p-6">
            <div class="flex justify-between">
                <div class="text-2xl font-bold tracking-tight text-[#fafafa]">Schedule Planner {{ $year }}</div>
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
            <hr class="my-[24px] border-[#27272a]">
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

        <div class="p-6">
            <div @if ($weeks_number == 4) class="grid grid-cols-[150px_repeat(4,1fr)]" @endif
                @if ($weeks_number == 5) class="grid grid-cols-[150px_repeat(5,1fr)]" @endif
                @if ($weeks_number == 6) class="grid grid-cols-[150px_repeat(6,1fr)]" @endif>
                <div class="border border-[#27272a]">
                    Date
                </div>
                @foreach ($month_weeks as $weeks)
                    <div class="grid grid-cols-7 hover:bg-[#27272a]">
                        @foreach ($weeks as $day)
                            <div class="border border-[#27272a] text-center">
                                {{ $day['day'] }}
                            </div>
                        @endforeach
                    </div>
                @endforeach
                <div class="border border-[#27272a]">
                    Day
                </div>
                @for ($i = 0; $i < $weeks_number; $i++)
                    <div class="grid grid-cols-7">
                        <div class="border border-[#27272a] text-center bg-[#18181B]/[0.6]">Su</div>
                        <div class="border border-[#27272a] text-center">Mo</div>
                        <div class="border border-[#27272a] text-center">Tu</div>
                        <div class="border border-[#27272a] text-center">We</div>
                        <div class="border border-[#27272a] text-center">Th</div>
                        <div class="border border-[#27272a] text-center">Fr</div>
                        <div class="border border-[#27272a] text-center bg-[#18181B]/[0.6]">Sa</div>
                    </div>
                @endfor
                @foreach ($users as $user)
                    <div class="border border-[#27272a]">
                        {{ $user->first_name }} {{ $user->last_name }}
                    </div>

                    @foreach ($schedule_data[$user->id] as $user_week => $schedule_value)
                        <div class="grid grid-cols-7 hover:border hover:border-[#fafafa]" onclick="openModal(this)"
                            id="{{ $user->id }}-{{ $user_week }}">
                            @foreach ($schedule_value as $day => $data)
                                @if ($day === array_key_first($schedule_value) || $day === array_key_last($schedule_value))
                                    <div class="border border-[#27272a] bg-[#18181B]/[0.6] text-center text-xs">
                                        {{ $data }}
                                    </div>
                                @else
                                    <div class="border border-[#27272a] text-center text-xs">
                                        {{ $data }}
                                    </div>
                                @endif
                            @endforeach
                        </div>
                    @endforeach
                @endforeach
            </div>
        </div>
        @foreach ($users as $user)
            @foreach ($user_schedule as $user_week)
                <div id="{{ $user->id }}-{{ $user_week }}-modal"
                    class=" fixed z-10 left-0 top-0 w-full h-full overflow-auto bg-[#18181B]/[0.6] hidden">
                    <div class="bg-[#09090b] mx-auto mt-[300px] p-5 border border-[#27272a] w-[35%]">
                        <div class="p-1">
                            <div class="flex justify-between">
                                <div class="text-2xl font-bold tracking-tight text-[#fafafa]">Select user schedule</div>
                                <span class="close" onclick="closeModal(this)"
                                    id="{{ $user->id }}-{{ $user_week }}">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20"
                                        viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                        stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-circle-x">
                                        <circle cx="12" cy="12" r="10" />
                                        <path d="m15 9-6 6" />
                                        <path d="m9 9 6 6" />
                                    </svg>
                                </span>
                            </div>
                            <hr class="my-[10px] border-[#27272a]">
                            <div>
                                <form action="{{ route('schedule.planner.store') }}" class="flex flex-col" method="POST">
                                    @csrf
                                    @foreach ($schedule_list as $schedule)
                                        <div class="flex gap-2 items-center">
                                            <button class="w-[16px] h-[16px] border border-[#fafafa] rounded-full"
                                                type="button" onclick="button_select_radio(this)"
                                                id="{{ $schedule->id }}-{{ $user->id }}-{{ $user_week }}">
                                                <span
                                                    class="flex items-center justify-center"id="{{ $schedule->id }}-{{ $user->id }}-{{ $user_week }}-span"></span>
                                            </button>
                                            <div class="flex gap-2">
                                                <input type="hidden" name="year" value="{{ $year }}">
                                                <input type="hidden" name="month" value="{{ $month }}">
                                                <input type="hidden" name="user_id" value="{{ $user->id }}">
                                                <input type="hidden" name="week_number" value="{{ $user_week }}">
                                                <input type="radio"
                                                    id="{{ $schedule->id }}-{{ $user->id }}-{{ $user_week }}-radio"
                                                    name="schedule_id" value={{ $schedule->id }} class="hidden">
                                                <label
                                                    for="{{ $schedule->id }}-{{ $user->id }}-{{ $user_week }}-radio"
                                                    id="{{ $schedule->id }}-{{ $user->id }}-{{ $user_week }}-label"
                                                    onclick="label_select_radio('{{ $schedule->id }}-{{ $user->id }}-{{ $user_week }}')">
                                                    {{ $schedule->name }}</label>
                                            </div>
                                        </div>
                                    @endforeach
                                    <button
                                        class="bg-[#fafafa] text-[#09090b] font-medium rounded-md h-9 mr-auto mt-2 px-6 text-sm">Select</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        @endforeach
    </div>
    <script>
        function openModal(value) {
            modal = document.getElementById(value.id + "-modal")
            modal.style.display = "block"
        }

        function closeModal(value) {
            modal = document.getElementById(value.id + "-modal")
            modal.style.display = "none"
        }

        window.onclick = function(event) {
            if (event.target == modal) {
                modal.style.display = 'none'
            }
        }

        function button_select_radio(value) {
            label = document.getElementById(value.id + "-label")
            span = document.getElementById(value.id + "-span")
            svgs = document.getElementById('svg')
            const svg =
                "<svg id='svg' xmlns='http://www.w3.org/2000/svg' width='24' height='24' viewBox='0 0 24 24' fill='none' stroke='currentColor' stroke-width='2' stroke-linecap='round' stroke-linejoin='round' class='lucide lucide-circle h-3.5 w-3.5 fill-[#fafafa]'><circle cx='12' cy='12' r='10'></circle></svg>"
            label.click()
            if (svgs) {
                svgs.remove()
            }
            span.innerHTML = svg
        }

        function label_select_radio(value) {
            span = document.getElementById(value + "-span")
            const svg =
                "<svg id='svg' xmlns='http://www.w3.org/2000/svg' width='24' height='24' viewBox='0 0 24 24' fill='none' stroke='currentColor' stroke-width='2' stroke-linecap='round' stroke-linejoin='round' class='lucide lucide-circle h-3.5 w-3.5 fill-[#fafafa]'><circle cx='12' cy='12' r='10'></circle></svg>"
            svgs = document.getElementById('svg')
            if (svgs) {
                svgs.remove()
            }
            span.innerHTML = svg
        }
    </script>
@endsection
