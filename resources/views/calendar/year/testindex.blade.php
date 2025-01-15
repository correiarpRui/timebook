@extends('layouts.testlayout')

@section('content')
    <div class="px-6">
        <div class=" border rounded-md bg-white mb-6 mt-6">
            <div class="border-b flex justify-between p-4 items-center">
                <p class="font-semibold text-xl">Calendar {{ $year }}</p>
                <div class="flex gap-3">
                    <a href="{{ route('calendar.year', $year - 1) }}"
                        class="flex items-center justify-center border p-2 rounded-md gap-2 hover:bg-[#eff0f6] w-[75px]">
                        <span>previous</span></a>
                    <a href="{{ route('calendar.year', $year + 1) }}"
                        class="flex items-center justify-center border p-2 rounded-md gap-2 hover:bg-[#eff0f6] w-[75px]">
                        <span>next</span></a>
                </div>
            </div>
            <div class="mx-6 py-6 overflow-auto">
                <div @if ($calendar_data['total_cells'] == 32) class="grid grid-cols-32" @endif
                    @if ($calendar_data['total_cells'] == 33) class="grid grid-cols-33" @endif
                    @if ($calendar_data['total_cells'] == 34) class="grid grid-cols-34" @endif
                    @if ($calendar_data['total_cells'] == 35) class="grid grid-cols-35" @endif
                    @if ($calendar_data['total_cells'] == 36) class="grid grid-cols-36" @endif
                    @if ($calendar_data['total_cells'] == 37) class="grid grid-cols-37" @endif
                    @if ($calendar_data['total_cells'] == 38) class="grid grid-cols-38" @endif>
                    <div class="font-medium text-sm">
                        &nbsp
                    </div>
                    @foreach ($calendar_data['first_row'] as $cell)
                        <div
                            class="cell border font-semibold h-8 flex items-center justify-center
                        @if (!$cell['weekday']) bg-[#DFE2E4] @endif">
                            {{ $cell['value'] }}
                        </div>
                    @endforeach
                </div>
                <form action="{{ route('calendar.store', $year) }}" method="POST" id="calendar_new_form">
                    @csrf
                    @foreach ($calendar_data['month_rows'] as $data => $month)
                        <div @if ($calendar_data['total_cells'] == 32) class="grid grid-cols-32" @endif
                            @if ($calendar_data['total_cells'] == 33) class="grid grid-cols-33" @endif
                            @if ($calendar_data['total_cells'] == 34) class="grid grid-cols-34" @endif
                            @if ($calendar_data['total_cells'] == 35) class="grid grid-cols-35" @endif
                            @if ($calendar_data['total_cells'] == 36) class="grid grid-cols-36" @endif
                            @if ($calendar_data['total_cells'] == 37) class="grid grid-cols-37" @endif
                            @if ($calendar_data['total_cells'] == 38) class="grid grid-cols-38" @endif>
                            <div
                                class="font-semibold text-sm py-1 border h-8 text-center border-l-[2px] @if ($data === 'January') border-t-[2px] @endif">
                                {{ $data }}
                            </div>
                            @foreach ($month as $day)
                                <div
                                    class=" text-center border text-sm w-full h-full relative 
                                {{ !$day['weekday'] ? 'bg-[#DFE2E4]' : '' }}
                                {{ $day['event'] ? 'bg-[#eb9c35]/[0.8] border-[#eb9c35]' : '' }}
                                {{ $day['holiday'] ? 'bg-[#92CD28]/[0.6] border-[#92CD28]' : '' }}
                                {{ $day['today'] ? 'bg-[#ff7f31]/[0.8] text-white font-semibold border-[#ff7f31]' : '' }}">
                                    <input type="checkbox" class="hidden peer" id="{{ $day['id'] }}"
                                        {{ $day['id'] == 0 || $day['event'] ? 'disabled' : '' }}
                                        onclick=" return limit_vacation_days({{ $user_vacations->vacation_days_left }})"
                                        value="{{ $day['id'] }}" name="{{ $day['id'] }}">
                                    <label for="{{ $day['id'] }}"
                                        class="h-full w-full py-1 flex justify-center align-middle absolute left-0 top-0 peer-checked:bg-[#fee08b]/[0.8] peer-checked:border-3px peer-checked:border-[#fee08b]">{{ $day['value'] }}</label>
                                </div>
                            @endforeach
                        </div>
                    @endforeach
                </form>
                <div class="mt-2 flex justify-between">
                    <button
                        class="hover:bg-[#ff7f31] bg-[#FF8B45] font-semibold rounded-md h-9 mx-5 px-6 text-white tracking-wider"
                        type="submit" form="calendar_new_form">Submit
                    </button>
                    <div>
                        <span
                            class="bg-[#ff7f31]/[0.8] border-[#ff7f31] font-semibold px-3 py-1 rounded-md mr-2 text-xs">Today</span>
                        <span
                            class="bg-[#92CD28]/[0.6] border-[#92CD28] font-semibold px-3 py-1 rounded-md mr-2 text-xs">Holiday</span>
                        <span
                            class="bg-[#eb9c35]/[0.8] border-[#eb9c35] font-semibold px-3 py-1 rounded-md mr-2 text-xs">Vacation</span>
                    </div>
                </div>
                <div class="p-4 flex flex-col gap-2">
                    <div class="flex items-end gap-2">
                        <p class="font-semibold text-md">Vacation days available:</p>
                        <p id="vacation_days" class="text-md">
                            {{ $user_vacations->vacation_days_left }}
                        </p>
                    </div>
                    <div class="flex items-end gap-2">
                        <p class="font-semibold text-md">Vacation days submitted:</p>
                        <p id="vacation_days" class="text-md">
                            {{ $user_vacations->vacation_days - $user_vacations->vacation_days_left }}
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        function limit_vacation_days(vacation_days) {
            let days = document.querySelectorAll('input[type=checkbox]:not([disabled])')
            let vacation_days_indicator = document.getElementById('vacation_days')
            let vacation_days_left = parseInt(vacation_days_indicator.innerText)
            let selected_days = 0;

            for (let count = 0; count < days.length; count++) {
                if (days[count].checked == true) {
                    selected_days++;
                }
            }
            vacation_days_left = vacation_days - selected_days;
            if (selected_days > vacation_days) {
                return false
            }
            vacation_days_indicator.innerText = vacation_days_left
        }
    </script>
@endsection
