@extends('layouts.testlayout')

@section('content')
    <div class="px-6">
        <div class=" border rounded-md bg-white mb-6 mt-6">
            <div class="border-b flex justify-between p-4 items-center">
                <p class="font-semibold text-xl">{{ $month_name }} {{ $year }}</p>
                <div class="flex gap-3">
                    <a href="{{ route('schedule.planner', [$year - 1, $month]) }}"
                        class="flex items-center justify-center border p-2 rounded-md gap-2 hover:bg-[#eff0f6] w-[75px]">
                        <span>previous</span></a>
                    <a href="{{ route('schedule.planner', [$year + 1, $month]) }}"
                        class="flex items-center justify-center border p-2 rounded-md gap-2 hover:bg-[#eff0f6] w-[75px]">
                        <span>next</span></a>
                </div>
            </div>

            <div class="p-6">
                <div @if ($weeks_number == 4) class="grid grid-cols-[150px_repeat(4,1fr)]" @endif
                    @if ($weeks_number == 5) class="grid grid-cols-[150px_repeat(5,1fr)]" @endif
                    @if ($weeks_number == 6) class="grid grid-cols-[150px_repeat(6,1fr)]" @endif>
                    <div
                        class="border border-b-[0px] border-t-[0px] border-l-[0px] flex justify-center items-center font-semibold">

                    </div>
                    @foreach ($month_weeks as $weeks)
                        <div class="grid grid-cols-7 h-10">
                            @foreach ($weeks as $key => $day)
                                <div
                                    class="border border-l-[0px]  
                                    bg-[{{ $day['color'] }}]
                                    text-center flex justify-center items-center">
                                    {{ $day['day'] }}
                                </div>
                            @endforeach
                        </div>
                    @endforeach
                    <div class="border border-l-[0px] border-t-[0px] flex justify-center items-center font-semibold">

                    </div>
                    @foreach ($month_weeks as $weeks)
                        <div class="grid grid-cols-7 h-10">
                            @foreach ($weeks as $key => $day)
                                <div
                                    class="border border-l-[0px] border-t-[0px] text-center flex justify-center items-center bg-[{{ $day['color'] }}]">
                                    {{ $day['weekday'][0] }}
                                </div>
                            @endforeach
                        </div>
                    @endforeach

                    @foreach ($users as $user)
                        <div class="border border-t-[0px] flex justify-center items-center font-semibold">
                            {{ $user->first_name }} {{ $user->last_name }}
                        </div>
                        @foreach ($month_weeks as $week_index => $weeks)
                            <div class="grid grid-cols-7 h-10 hover:backdrop-brightness-[90%]" onclick="openModal(this)"
                                id="{{ $user->id }}-{{ $week_index }}">
                                @foreach ($weeks as $key => $day)
                                    <div
                                        class="border border-l-[0px] border-t-[0px] text-center flex justify-center items-center 
                                    bg-[{{ $day['color'] }}]">
                                        {{ $day['users_schedule'][$user->id] }}
                                    </div>
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
                        <div class="bg-white mx-auto mt-[300px] p-5 w-[300px] rounded-lg">
                            <div class="flex flex-col items-center">
                                <div class="w-full text-xl font-bold tracking-tight mb-5">Select schedule</div>

                                <div class="w-full">
                                    <form action="{{ route('schedule.planner.store') }}" class="flex flex-col"
                                        method="POST">
                                        @csrf
                                        @foreach ($schedule_list as $schedule)
                                            <div class="flex gap-2 items-center border mb-2 p-2 rounded-md hover:bg-[#eff0f6] cursor-pointer"
                                                onclick="button_select_radio(this)"
                                                id="{{ $schedule->id }}-{{ $user->id }}-{{ $user_week }}">
                                                <span
                                                    class="flex items-center justify-center "id="{{ $schedule->id }}-{{ $user->id }}-{{ $user_week }}-span">
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                                        viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                                        stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                                                        class="lucide lucide-square" id="unchecked">
                                                        <rect width="18" height="18" x="3" y="3" rx="2" />
                                                    </svg>
                                                </span>
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
                                        <div class="flex gap-2 justify-center">
                                            <button
                                                class="hover:bg-[#ff7f31] bg-[#FF8B45] font-semibold rounded-md h-9 px-6 text-white tracking-wider">Select</button>
                                            <button
                                                class="font-semibold border rounded-md h-9 px-6 tracking-wider flex items-center bg-[#f4f5f7] border-[#CBCFD2] hover:bg-[#CBCFD2] hover:border-[#dae0e5]"
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
            label.click()
        }

        function label_select_radio(value) {
            span = document.getElementById(value + "-span")
            child = span.children[0];
            checked_svg = document.getElementById('square_check')
            if (checked_svg) {
                parent = checked_svg.parentNode
                parent.innerHTML =
                    "<svg xmlns='http://www.w3.org/2000/svg' width='24' height='24' viewBox='0 0 24 24' fill='none' stroke='currentColor'stroke-width='2' stroke-linecap='round' stroke-linejoin='round'class='lucide lucide-square' id='unchecked'><rect width='18' height='18' x='3' y='3' rx='2' /></svg>"
            }
            span.innerHTML =
                "<svg id='square_check' xmlns='http://www.w3.org/2000/svg' width='24' height='24' viewBox='0 0 24 24' fill='none' stroke='currentColor' stroke-width='2' stroke-linecap='round' stroke-linejoin='round' class='lucide lucide-square-check-big'><path d='M21 10.5V19a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h12.5'/><path d='m9 11 3 3L22 4'/></svg>"
        }
    </script>
@endsection
