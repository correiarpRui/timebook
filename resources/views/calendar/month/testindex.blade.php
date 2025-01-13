@extends('layouts.testlayout')

@section('content')
    {{-- border-[#eff0f6] --}}
    <div class="px-6">
        <div class=" border rounded-md bg-white mb-6 mt-6">
            <div class="border-b flex justify-between p-4 items-center">
                <p class="font-semibold text-xl">{{ $month_name }} {{ $year }}</p>
                <div class="flex gap-3">
                    <a href="{{ route('calendar.month', $month == 1 ? [$year - 1, 12] : [$year, $month - 1]) }}"
                        class="flex items-center border p-2 rounded-md gap-2 hover:bg-[#eff0f6]">
                        <svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" viewBox="0 0 24 24"
                            fill="none" stroke="currentColor" stroke-width="1" stroke-linecap="round"
                            stroke-linejoin="round" class="lucide lucide-arrow-big-left">
                            <path d="M18 15h-6v4l-7-7 7-7v4h6v6z" />
                        </svg></a>
                    <a href="{{ route('calendar.month', $month == 12 ? [$year + 1, 1] : [$year, $month + 1]) }}"
                        class="flex items-center border p-2 rounded-md gap-2 hover:bg-[#eff0f6]">
                        <svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" viewBox="0 0 24 24"
                            fill="none" stroke="currentColor" stroke-width="1" stroke-linecap="round"
                            stroke-linejoin="round" class="lucide lucide-arrow-big-right">
                            <path d="M6 9h6V5l7 7-7 7v-4H6V9z" />
                        </svg></a>
                </div>
            </div>
            <div class="p-6">
                <div @if ($days_in_month + 1 == 29) class="grid grid-cols-29" @endif
                    @if ($days_in_month + 1 == 30) class="grid grid-cols-30" @endif
                    @if ($days_in_month + 1 == 31) class="grid grid-cols-31" @endif
                    @if ($days_in_month + 1 == 32) class="grid grid-cols-32" @endif>
                    <div
                        class="border border-b-[0px] border-t-[0px] border-l-[0px] flex justify-center items-center font-semibold">

                    </div>
                    @foreach ($table_data['month']['date'] as $table_cell)
                        <div
                            class="cell-{{ $table_cell['day'] }} h-10 border border-l-[0px] text-center flex justify-center items-center
                            
                        @if ($table_cell['today']) bg-[#ff7f31] text-white
                        @elseif ($table_cell['holiday'])  bg-[#106a2e]/[0.2]
                        @elseif (!$table_cell['weekday'])  bg-[#DFE2E4]
                        @else bg-transparent @endif">
                            {{ $table_cell['day'] }}
                        </div>
                    @endforeach
                    <div class="border border-l-[0px] border-t-[0px] flex justify-center items-center font-semibold">
                    </div>
                    @foreach ($table_data['month']['date'] as $table_cell)
                        <div
                            class="cell-{{ $table_cell['day'] }} border border-l-[0px] border-t-[0px] text-center flex justify-center items-center h-10
                        @if ($table_cell['today']) bg-[#ff7f31] text-white
                        @elseif ($table_cell['holiday'])  bg-[#106a2e]/[0.2]
                        @elseif (!$table_cell['weekday'])  bg-[#DFE2E4]
                        @else bg-transparent @endif">
                            {{ $table_cell['week_day'] }}
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
@endsection
