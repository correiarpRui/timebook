@extends('layouts.layout')

@section('content')
    {{-- <div class="text-[#fafafa] p-6">
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

        <div class="overflow-hidden block">
            <table class="text-sm border-[#27272a] text-[#fafafa] w-full overflow-auto">
                <colgroup>
                    @foreach ($table_data['month']['day'] as $table_cell)
                        @if ($table_cell == 'S')
                            <col span="1" class="weekend">
                        @else
                            <col span="1">
                        @endif
                    @endforeach
                </colgroup>
                <thead>
                    <tr>
                        @foreach ($table_data['month']['date'] as $table_cell)
                            <th class="font-medium w-fit h-[40px]">
                                <div class="h-7 w-7 flex items-center justify-center m-auto">{{ $table_cell }}</div>
                            </th>
                        @endforeach
                    </tr>
                    <tr>
                        @foreach ($table_data['month']['day'] as $table_cell)
                            <th class="font-medium w-fit h-[30px]">
                                <div class="h-7 w-7 flex items-center justify-center m-auto">{{ $table_cell }}
                                </div>
                            </th>
                        @endforeach
                    </tr>
                </thead>
                <tbody>
                    @foreach ($table_data['users'] as $user)
                        <tr>
                            <td class="font-medium text-left w-[30px] h-[30px]">
                                <div class="h-7 w-7 flex items-center justify-start whitespace-nowrap">
                                    {{ $user['user_info']['name'] }}
                                </div>
                            </td>
                            @foreach ($user['data'] as $table_cell)
                                <td
                                    @if ($table_cell['event'] == 'vacation') class="font-medium w-[30px] h-[30px]"
                            @else class="text-[#323232] font-medium w-[30px] h-[30px]" @endif>
                                    <div
                                        class="rounded-lg h-7 w-7 flex items-center justify-center m-auto @if ($table_cell['event'] == 'vacation') bg-[#fafafa] text-[#09090b] @endif">
                                        {{ $table_cell['day'] }}
                                    </div>
                                </td>
                            @endforeach
                        </tr>
                    @endforeach

                </tbody>

            </table>
        </div>

    </div> --}}
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
            <div class="grid grid-cols-{{ $days_in_month + 1 }}">
                <div class="font-medium text-sm">
                    {{ $table_data['month']['date']['title'] }}
                </div>
                @foreach ($table_data['month']['date']['values'] as $table_cell)
                    <div class="text-center cell">
                        {{ $table_cell }}
                    </div>
                @endforeach
                <div class="font-medium text-sm">
                    {{ $table_data['month']['day']['title'] }}
                </div>
                @foreach ($table_data['month']['day']['values'] as $table_cell)
                    <div class="text-center cell">
                        {{ $table_cell }}
                    </div>
                @endforeach
            </div>
            @foreach ($table_data['users'] as $user)
                <div class="grid grid-cols-{{ $days_in_month + 1 }}">
                    <div class="font-medium text-sm">
                        {{ $user['user_info']['name'] }}
                    </div>
                    @foreach ($user['data'] as $table_cell)
                        <div
                            @if ($table_cell['event'] == 'vacation') class="text-center cell col-span-{{ $table_cell['range'] }}" @else class="text-[#323232] text-center cell" @endif>
                            <div class="@if ($table_cell['event'] == 'vacation') bg-[#fafafa] text-[#09090b] @endif">
                                &nbsp
                            </div>
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
        background-color: #27272a;
        width: 100%;
        height: 10000px;
        position: absolute;
        z-index: -1;
        top: -1000px;
        left: 0;
    }
</style>
