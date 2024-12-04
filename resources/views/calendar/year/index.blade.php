@extends('layouts.layout')

@section('content')
    <div class="text-[#fafafa] p-6">
        <div class="flex justify-between">
            <div class="text-2xl font-bold tracking-tight text-[#fafafa]">Calendar {{ $year }}</div>
            <div class="flex gap-3">
                <a class="bg-[#fafafa] text-[#09090b] flex items-center gap-2 rounded-md px-4 py-2 cursor-pointer text-sm font-medium"
                    href="{{ route('calendar.year', $year - 1) }}">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none"
                        stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                        class="lucide lucide-chevron-left">
                        <path d="m15 18-6-6 6-6" />
                    </svg>
                </a>
                <a class="bg-[#fafafa] text-[#09090b] flex items-center gap-2 rounded-md px-4 py-2 cursor-pointer text-sm font-medium"
                    href="{{ route('calendar.year', $year + 1) }}">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none"
                        stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                        class="lucide lucide-chevron-right">
                        <path d="m9 18 6-6-6-6" />
                    </svg>
                </a>
            </div>
        </div>
        <hr class="my-[24px] border-[#27272a]">
        <div class="overflow-hidden">
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
                        class="text-center cell border border-[#27272a]
                        @if (!$cell['weekday']) bg-[#18181B]/[0.6] @endif">
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
                        @if ($calendar_data['total_cells'] == 37) class="grid grid-cols-37 hover:border-y hover:border-[#fafafa]" @endif
                        @if ($calendar_data['total_cells'] == 38) class="grid grid-cols-38" @endif>
                        <div class="font-medium text-sm py-1 border border-[#27272a] h-8 text-center">
                            {{ $data }}
                        </div>
                        @foreach ($month as $day)
                            <div
                                class=" text-center border border-[#27272a] text-sm w-full h-full relative   
                            @if (!$day['weekday']) bg-[#18181B]/[0.8] @endif
                            @if ($day['event']) bg-[#2662D9]/[0.3] border-[#2662D9]/[0.2] @endif
                            @if ($day['holiday']) bg-[#EB7E47]/[0.3] border-[#EB7E47]/[0.2] @endif
                            @if ($day['today']) bg-[#F17E92]/[0.3] border-[#F17E92]/[0.2] @endif">
                                <input type="checkbox" class="hidden peer" id="{{ $day['id'] }}"
                                    value="{{ $day['id'] }}" name="{{ $day['id'] }}">
                                <label for="{{ $day['id'] }}"
                                    class="h-full w-full py-1 flex justify-center align-middle absolute left-0 top-0 peer-checked:bg-[#bbbbbd] peer-checked:border-3px peer-checked:border-[#bbbbbd] peer-checked:text-[#09090b] ">{{ $day['value'] }}</label>
                            </div>
                        @endforeach

                    </div>
                @endforeach
            </form>
        </div>
        <button class="bg-[#fafafa] text-[#09090b] font-medium rounded-md h-9 mr-auto mt-2 px-6 text-sm" type="submit"
            form="calendar_new_form">Submit</button>
    </div>
@endsection
