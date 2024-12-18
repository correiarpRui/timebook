@extends('layouts.layout')

@section('content')
    <div class="text-[#fafafa]">
        <div class="p-6">
            <div class="flex justify-between">
                <div class="text-2xl font-bold tracking-tight text-[#fafafa]">Schedule Planner {{ $year }}</div>
                <div class="flex gap-2">
                    <a href="{{ route('schedule.planner', [$year - 1, $month]) }}" class="bg-[#fafafa] p-2 rounded-md">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24"
                            fill="none" stroke="#09090b" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                            class="lucide lucide-chevron-left">
                            <path d="m15 18-6-6 6-6" />
                        </svg>
                    </a>
                    <a href="{{ route('schedule.planner', [$year + 1, $month]) }}" class="bg-[#fafafa] p-2 rounded-md">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24"
                            fill="none" stroke="#09090b" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                            class="lucide lucide-chevron-right">
                            <path d="m9 18 6-6-6-6" />
                        </svg>
                    </a>
                </div>
            </div>
            <hr class="my-[24px] border-[#27272a]">
            <div class="grid grid-cols-12 text-center items-center">
                <a href="{{ route('schedule.planner', [$year, 1]) }}"
                    class="rounded-full font-medium text-sm h-7 px-4 flex items-center justify-center hover:text-[#fafafa] {{ $month_name == 'January' ? 'text-[#fafafa] bg-[#27272a]' : 'text-[#a1a1aa]' }}">January</a>
                <a href="{{ route('schedule.planner', [$year, 2]) }}"
                    class="rounded-full font-medium text-sm h-7 px-4 flex items-center justify-center hover:text-[#fafafa] {{ $month_name == 'February' ? 'text-[#fafafa] bg-[#27272a]' : 'text-[#a1a1aa]' }}">February</a>
                <a href="{{ route('schedule.planner', [$year, 3]) }}"
                    class="rounded-full font-medium text-sm h-7 px-4 flex items-center justify-center hover:text-[#fafafa] {{ $month_name == 'March' ? 'text-[#fafafa] bg-[#27272a]' : 'text-[#a1a1aa]' }}">March</a>
                <a href="{{ route('schedule.planner', [$year, 4]) }}"
                    class="rounded-full font-medium text-sm h-7 px-4 flex items-center justify-center hover:text-[#fafafa] {{ $month_name == 'April' ? 'text-[#fafafa] bg-[#27272a]' : 'text-[#a1a1aa]' }}">April</a>
                <a href="{{ route('schedule.planner', [$year, 5]) }}"
                    class="rounded-full font-medium text-sm h-7 px-4 flex items-center justify-center hover:text-[#fafafa] {{ $month_name == 'May' ? 'text-[#fafafa] bg-[#27272a]' : 'text-[#a1a1aa]' }}">May</a>
                <a href="{{ route('schedule.planner', [$year, 6]) }}"
                    class="rounded-full font-medium text-sm h-7 px-4 flex items-center justify-center hover:text-[#fafafa] {{ $month_name == 'June' ? 'text-[#fafafa] bg-[#27272a]' : 'text-[#a1a1aa]' }}">June</a>
                <a href="{{ route('schedule.planner', [$year, 7]) }}"
                    class="rounded-full font-medium text-sm h-7 px-4 flex items-center justify-center hover:text-[#fafafa] {{ $month_name == 'July' ? 'text-[#fafafa] bg-[#27272a]' : 'text-[#a1a1aa]' }}">July</a>
                <a href="{{ route('schedule.planner', [$year, 8]) }}"
                    class="rounded-full font-medium text-sm h-7 px-4 flex items-center justify-center hover:text-[#fafafa] {{ $month_name == 'August' ? 'text-[#fafafa] bg-[#27272a]' : 'text-[#a1a1aa]' }}">August</a>
                <a href="{{ route('schedule.planner', [$year, 9]) }}"
                    class="rounded-full font-medium text-sm h-7 px-4 flex items-center justify-center hover:text-[#fafafa] {{ $month_name == 'September' ? 'text-[#fafafa] bg-[#27272a]' : 'text-[#a1a1aa]' }}">September</a>
                <a href="{{ route('schedule.planner', [$year, 10]) }}"
                    class="rounded-full font-medium text-sm h-7 px-4 flex items-center justify-center hover:text-[#fafafa] {{ $month_name == 'October' ? 'text-[#fafafa] bg-[#27272a]' : 'text-[#a1a1aa]' }}">October</a>
                <a href="{{ route('schedule.planner', [$year, 11]) }}"
                    class="rounded-full font-medium text-sm h-7 px-4 flex items-center justify-center hover:text-[#fafafa] {{ $month_name == 'November' ? 'text-[#fafafa] bg-[#27272a]' : 'text-[#a1a1aa]' }}">November</a>
                <a href="{{ route('schedule.planner', [$year, 12]) }}"
                    class="rounded-full font-medium text-sm h-7 px-4 flex items-center justify-center hover:text-[#fafafa] {{ $month_name == 'December' ? 'text-[#fafafa] bg-[#27272a]' : 'text-[#a1a1aa]' }}">December</a>
            </div>
        </div>

        <div class="p-6">
            <div @if ($weeks_number == 4) class="grid grid-cols-[150px_repeat(4,1fr)]" @endif
                @if ($weeks_number == 5) class="grid grid-cols-[150px_repeat(5,1fr)]" @endif
                @if ($weeks_number == 6) class="grid grid-cols-[150px_repeat(6,1fr)]" @endif>
                <div class="border border-[#27272a] flex justify-center items-center">
                    Date
                </div>
                @foreach ($month_weeks as $weeks)
                    <div class="grid grid-cols-7 text-[#fafafa] h-10">
                        @foreach ($weeks as $day)
                            <div class="border border-[#27272a] text-center flex justify-center items-center">
                                {{ $day['day'] }}
                            </div>
                        @endforeach
                    </div>
                @endforeach
                <div class="border border-[#27272a] flex justify-center items-center">
                    Day
                </div>
                @for ($i = 0; $i < $weeks_number; $i++)
                    <div class="grid grid-cols-7 h-10">
                        <div
                            class="border border-[#27272a] text-center bg-[#18181B]/[0.6] flex justify-center items-center">
                            Su</div>
                        <div class="border border-[#27272a] text-center flex justify-center items-center">Mo</div>
                        <div class="border border-[#27272a] text-center flex justify-center items-center">Tu</div>
                        <div class="border border-[#27272a] text-center flex justify-center items-center">We</div>
                        <div class="border border-[#27272a] text-center flex justify-center items-center">Th</div>
                        <div class="border border-[#27272a] text-center flex justify-center items-center">Fr</div>
                        <div
                            class="border border-[#27272a] text-center bg-[#18181B]/[0.6] flex justify-center items-center">
                            Sa</div>
                    </div>
                @endfor
                @foreach ($users as $user)
                    <div class="border border-[#27272a] flex justify-center items-center">
                        {{ $user->first_name }} {{ $user->last_name }}
                    </div>

                    @foreach ($schedule_data[$user->id] as $user_week => $schedule_value)
                        <div class="grid grid-cols-7 hover:border hover:border-[#fafafa] h-10" onclick="openModal(this)"
                            id="{{ $user->id }}-{{ $user_week }}">
                            @foreach ($schedule_value as $day => $data)
                                @if ($day === array_key_first($schedule_value) || $day === array_key_last($schedule_value))
                                    <div
                                        class="border border-[#27272a] bg-[#18181B]/[0.6] text-center text-xs flex justify-center items-center">
                                        {{ $data }}
                                    </div>
                                @else
                                    <div
                                        class="border border-[#27272a] text-center text-xs flex justify-center items-center">
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
                    <div class="bg-[#09090b] mx-auto mt-[300px] p-5 border border-[#27272a] w-[35%] rounded-lg">
                        <div class="p-1">
                            <div class="text-2xl font-bold tracking-tight text-[#fafafa]">Select user schedule</div>
                            <hr class="my-[10px] border-[#27272a]">
                            <div>
                                <form action="{{ route('schedule.planner.store') }}" class="flex flex-col" method="POST">
                                    @csrf
                                    @foreach ($schedule_list as $schedule)
                                        <div class="flex gap-2 items-center border border-[#27272a] mb-2 p-2 rounded-md hover:border-[#fafafa] cursor-pointer"
                                            onclick="button_select_radio(this)"
                                            id="{{ $schedule->id }}-{{ $user->id }}-{{ $user_week }}">
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
                                                    onclick="label_select_radio('{{ $schedule->id }}-{{ $user->id }}-{{ $user_week }}')"
                                                    class="cursor-pointer">
                                                    {{ $schedule->name }}</label>
                                            </div>
                                        </div>
                                    @endforeach
                                    <div class="flex gap-2">
                                        <button
                                            class="bg-[#fafafa] text-[#09090b] font-medium rounded-md h-9 mt-2 px-6 text-sm">Select</button>
                                        <button
                                            class="bg-[#fafafa] text-[#09090b] font-medium rounded-md h-9 mt-2 px-6 text-sm"
                                            type="button" onclick="closeModal(this)"
                                            id="{{ $user->id }}-{{ $user_week }}">Cancel</button>
                                    </div>
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
