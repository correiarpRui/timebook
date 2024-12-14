@extends('layouts.layout')

@section('content')
    <div class="text-[#fafafa] p-6">
        <div class="flex justify-between">
            <div class="text-2xl font-bold tracking-tight text-[#fafafa]">{{ $month_name }}, {{ $year }}</div>
            <div class="flex gap-3">
                <a class="bg-[#fafafa] text-[#09090b] flex items-center gap-2 rounded-md px-4 py-2 cursor-pointer text-sm font-medium"
                    href="{{ route('calendar.month', $month == 1 ? [$year - 1, 12] : [$year, $month - 1]) }}">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none"
                        stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                        class="lucide lucide-chevron-left">
                        <path d="m15 18-6-6 6-6" />
                    </svg>
                </a>
                <a class="bg-[#fafafa] text-[#09090b] flex items-center gap-2 rounded-md px-4 py-2 cursor-pointer text-sm font-medium"
                    href="{{ route('calendar.month', $month == 12 ? [$year + 1, 1] : [$year, $month + 1]) }}">
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
            <div @if ($days_in_month + 1 == 29) class="grid grid-cols-29" @endif
                @if ($days_in_month + 1 == 30) class="grid grid-cols-30" @endif
                @if ($days_in_month + 1 == 31) class="grid grid-cols-31" @endif
                @if ($days_in_month + 1 == 32) class="grid grid-cols-32" @endif>
                <div class="font-medium text-sm border border-[#27272a]">
                    Date
                </div>
                @foreach ($table_data['month']['date'] as $table_cell)
                    <div
                        class="text-center cell border border-[#27272a]
                        @if (!$table_cell['weekday']) bg-[#18181B]/[0.6] @endif
                        @if ($table_cell['today']) bg-[#F17E92]/[0.2] border-[#F17E92]/[0.2] @endif
                        @if ($table_cell['holiday']) bg-[#EB7E47]/[0.2] border-[#EB7E47]/[0.2] @endif">
                        {{ $table_cell['value'] }}
                    </div>
                @endforeach
                <div class="font-medium text-sm border border-[#27272a]">
                    Day
                </div>
                @foreach ($table_data['month']['day'] as $table_cell)
                    <div
                        class="text-center cell border border-[#27272a] 
                        @if (!$table_cell['weekday']) bg-[#18181B]/[0.6] @endif
                        @if ($table_cell['today']) bg-[#F17E92]/[0.2] border-[#F17E92]/[0.2] @endif
                        @if ($table_cell['holiday']) bg-[#EB7E47]/[0.2] border-[#EB7E47]/[0.2] @endif">
                        {{ $table_cell['value'] }}
                    </div>
                @endforeach
            </div>
            @foreach ($table_data['users'] as $user)
                <div @if ($days_in_month + 1 == 29) class="grid grid-cols-29" @endif
                    @if ($days_in_month + 1 == 30) class="grid grid-cols-30" @endif
                    @if ($days_in_month + 1 == 31) class="grid grid-cols-31" @endif
                    @if ($days_in_month + 1 == 32) class="grid grid-cols-32" @endif>
                    <div class="font-medium text-sm py-1 border border-[#27272a]">
                        {{ $user['user_info']['name'] }}
                    </div>
                    @foreach ($user['data'] as $table_cell)
                        <div
                            class=" text-center py-1 border border-[#27272a] cell 
                            @if (!$table_cell['weekday']) bg-[#18181B]/[0.6] @endif
                            @if ($table_cell['today']) bg-[#F17E92]/[0.2] border-[#F17E92]/[0.2] @endif
                            @if ($table_cell['holiday']) bg-[#EB7E47]/[0.2] border-[#EB7E47]/[0.2] @endif">
                            @if (array_key_exists('start', $table_cell))
                                <div class="relative z-[10] bg-[#2662D9]/[0.6] border border-[#2662D9] overflow-hidden text-xs rounded-md h-full"
                                    style="width: calc({{ $table_cell['range'] }}*100% + ({{ $table_cell['range'] }}px - 1px) * 2) ">
                                    Vacation
                                </div>
                            @endif
                        </div>
                    @endforeach
                </div>
            @endforeach

        </div>



    </div>
@endsection

<style>
    .weekend {
        background-color: hsl(240 4 16 /0.20)
    }

    td:nth-child(1) {
        min-width: 60px
    }

    td {
        position: relative;
    }

    td:hover::after {
        content: "";
        background: #27272a;
        width: 100%;
        height: 10000px;
        position: absolute;
        top: -1000px;
        left: 0;
        z-index: -1;
    }

    .cell {
        position: relative;
    }

    .cell:hover::after {
        content: "";
        background-color: #27272a4d;
        width: 100%;
        height: 10000px;
        position: absolute;
        z-index: -1;
        top: -1000px;
        left: 0;
    }
</style>
