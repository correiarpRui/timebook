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
                <div class="font-medium text-sm border border-[#27272a] h-10 flex justify-center items-center">
                    Date
                </div>
                @foreach ($table_data['month']['date'] as $table_cell)
                    <div
                        class="text-center cell border border-[#27272a] h-10 flex justify-center items-center
                        @if (!$table_cell['weekday']) bg-[#18181B]/[0.6] @endif
                        @if ($table_cell['today']) bg-[#F17E92]/[0.2] border-[#F17E92]/[0.2] @endif
                        @if ($table_cell['holiday']) bg-[#EB7E47]/[0.2] border-[#EB7E47]/[0.2] @endif">
                        {{ $table_cell['value'] }}
                    </div>
                @endforeach
                <div class="font-medium text-sm border border-[#27272a] h-10 flex justify-center items-center">
                    Day
                </div>
                @foreach ($table_data['month']['day'] as $table_cell)
                    <div
                        class="text-center cell border border-[#27272a] h-10 flex justify-center items-center
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
                    <div class="font-medium text-sm py-1 h-12 border border-[#27272a] flex justify-center items-center">
                        {{ $user['user_info']['name'] }}
                    </div>
                    @foreach ($user['data'] as $table_cell)
                        <div
                            class=" text-center h-12 py-2 border border-[#27272a] cell
                            @if (!$table_cell['weekday']) bg-[#18181B]/[0.6] @endif
                            @if ($table_cell['today']) bg-[#F17E92]/[0.2] border-[#F17E92]/[0.2] @endif
                            @if ($table_cell['holiday']) bg-[#EB7E47]/[0.2] border-[#EB7E47]/[0.2] @endif">
                            @if (array_key_exists('start', $table_cell))
                                <div class="relative z-[10] bg-[#2662D9]/[0.6] border border-[#2662D9] overflow-clip rounded-md h-[26px] mt-[2px] flex justify-center gap-1 items-center"
                                    style="width: calc({{ $table_cell['range'] }}*100% + ({{ $table_cell['range'] }}px - 1px) * 2)">
                                    <button>
                                        <div class="bg-red-600 rounded-full p-[2px]">
                                            <svg width="12" height="12" viewBox="-2 0 10 10"
                                                id="meteor-icon-kit__regular-questionmark-s" fill="none"
                                                xmlns="http://www.w3.org/2000/svg">
                                                <path fill-rule="evenodd" clip-rule="evenodd"
                                                    d="M2 3C2 3.5523 1.5523 4 1 4C0.44772 4 0 3.5523 0 3C0 1.44772 1.4477 0 3 0C4.5523 0 6 1.44772 6 3C6 4.285 5.5004 4.8678 4.4472 5.3944C4.0004 5.6178 4 5.6183 4 6C4 6.5523 3.5523 7 3 7C2.4477 7 2 6.5523 2 6C2 4.715 2.4996 4.1322 3.5528 3.6056C3.9996 3.3822 4 3.3817 4 3C4 2.55228 3.4477 2 3 2C2.5523 2 2 2.55228 2 3zM3 10C2.4477 10 2 9.5523 2 9C2 8.4477 2.4477 8 3 8C3.5523 8 4 8.4477 4 9C4 9.5523 3.5523 10 3 10z"
                                                    fill="#fafafa" />
                                            </svg>
                                        </div>
                                    </button>
                                    <button>


                                    </button>
                                    {{-- <button>
                                        <div class="bg-green-600 rounded-full p-[2px]">
                                            <svg width="12" height="12" viewBox="0 -1 8 8"
                                                id="meteor-icon-kit__regular-checkmark-xxs" fill="none"
                                                xmlns="http://www.w3.org/2000/svg">
                                                <path fill-rule="evenodd" clip-rule="evenodd"
                                                    d="M1.70711 2.2929C1.31658 1.9024 0.68342 1.9024 0.29289 2.2929C-0.09763 2.6834 -0.09763 3.3166 0.29289 3.7071L2.2929 5.7071C2.6834 6.0976 3.3166 6.0976 3.7071 5.7071L7.7071 1.7071C8.0976 1.3166 8.0976 0.68342 7.7071 0.29289C7.3166 -0.09763 6.6834 -0.09763 6.2929 0.29289L3 3.5858L1.70711 2.2929z"
                                                    fill="#fafafa" />
                                            </svg>
                                        </div>
                                    </button> --}}
                                    <span class="text-sm font-semibold">Vacation</span>
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
