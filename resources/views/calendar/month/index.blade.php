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
        <div>
            <div @if ($days_in_month + 1 == 29) class="grid grid-cols-29" @endif
                @if ($days_in_month + 1 == 30) class="grid grid-cols-30" @endif
                @if ($days_in_month + 1 == 31) class="grid grid-cols-31" @endif
                @if ($days_in_month + 1 == 32) class="grid grid-cols-32" @endif>
                <div
                    class="font-medium text-sm h-10 flex justify-center items-center border border-[#fafafa]/[0.2] border-t-[2px] border-l-[2px]">
                    Date
                </div>
                @foreach ($table_data['month']['date'] as $table_cell)
                    <div
                        class="cell-{{ $table_cell['day'] }} text-center h-10 flex justify-center items-center  border border-[#fafafa]/[0.2] border-t-[2px]
                        {{ !$table_cell['weekday'] ? 'bg-[#5fa8fc]/[0.1]' : '' }}
                        {{ $table_cell['today'] ? 'bg-[#2eb88a]/[0.2]' : '' }}
                        {{ $table_cell['holiday'] ? 'bg-[#106a2e]/[0.2] ' : '' }}">
                        {{ $table_cell['day'] }}
                    </div>
                @endforeach
                <div
                    class="font-medium text-sm h-10 flex justify-center items-center border border-[#fafafa]/[0.2] border-l-[2px]">
                    Day
                </div>
                @foreach ($table_data['month']['date'] as $table_cell)
                    <div
                        class="cell-{{ $table_cell['day'] }} text-center h-10 flex justify-center items-center border border-[#fafafa]/[0.2]
                        {{ !$table_cell['weekday'] ? 'bg-[#5fa8fc]/[0.1]' : '' }}
                        {{ $table_cell['today'] ? 'bg-[#2eb88a]/[0.2]' : '' }}
                        {{ $table_cell['holiday'] ? 'bg-[#106a2e]/[0.2] ' : '' }}">
                        {{ $table_cell['week_day'] }}
                    </div>
                @endforeach
            </div>
            @foreach ($table_data['users'] as $user)
                <div @if ($days_in_month + 1 == 29) class="grid grid-cols-29" @endif
                    @if ($days_in_month + 1 == 30) class="grid grid-cols-30" @endif
                    @if ($days_in_month + 1 == 31) class="grid grid-cols-31" @endif
                    @if ($days_in_month + 1 == 32) class="grid grid-cols-32" @endif>
                    <div
                        class="font-medium text-sm py-1 h-12 flex justify-center items-center border border-[#fafafa]/[0.2] border-l-[2px]">
                        {{ $user['user_info']['name'] }}
                    </div>
                    @foreach ($user['data'] as $table_cell)
                        <div
                            class="cell-{{ $table_cell['day'] }} text-center h-12 py-2 border border-[#fafafa]/[0.2]
                            {{ !$table_cell['weekday'] ? 'bg-[#5fa8fc]/[0.1]' : '' }}
                            {{ $table_cell['today'] ? 'bg-[#2eb88a]/[0.2]' : '' }}
                            {{ $table_cell['holiday'] ? 'bg-[#106a2e]/[0.2] ' : '' }}">
                            @if (array_key_exists('start', $table_cell))
                                <div class="relative z-10 bg-[#e88c30] text-[#27272a] rounded-full h-[26px] mt-[2px] flex justify-center gap-1 items-center cursor-pointer"
                                    style="width: calc({{ $table_cell['range'] }}*100% + ({{ $table_cell['range'] }}px - 1px) * 2)"
                                    onclick=open_menu(this) id="{{ $table_cell['event_id'] }}">
                                    @if ($table_cell['status_id'] == 1)
                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                            viewBox="0 0 24 24" fill="#fa0000" stroke="#fafafa" stroke-width="3"
                                            stroke-linecap="round" stroke-linejoin="round"
                                            class="lucide lucide-circle-alert">
                                            <circle cx="12" cy="12" r="10" stroke="#fa0000"
                                                stroke-width="0" />
                                            <line x1="12" x2="12" y1="8" y2="12" />
                                            <line x1="12" x2="12.01" y1="16" y2="16" />
                                        </svg>
                                    @endif
                                    @if ($table_cell['status_id'] == 2)
                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                            viewBox="0 0 24 24" fill="#27272a" stroke="#e88c30" stroke-width="3"
                                            stroke-linecap="round" stroke-linejoin="round"
                                            class="lucide lucide-circle-check">
                                            <circle cx="12" cy="12" r="10" stroke-width="0" />
                                            <path d="m9 12 2 2 4-4" />
                                        </svg>
                                    @endif
                                    <span class="text-md font-medium">Vacation</span>
                                    <div class="bg-transparent rounded-md px-1 absolute w-[200px] z-40 top-[28px] left-[-5px] hidden"
                                        id="{{ $table_cell['event_id'] }}-menu">
                                        <div
                                            class=" bg-[#09090b] text-[#fafafa] p-2 border border-[#fafafa] rounded-md text-left flex flex-col ">
                                            <span>Vacation, {{ $table_cell['range'] }} days</span>
                                            <hr class="my-2 border-[#27272a]">
                                            <form action="{{ route('calendar.month.patch', $table_cell['event_id']) }}"
                                                method="POST" class="py-1 m-0">
                                                @csrf
                                                @method('PATCH')
                                                <input type="text" value="2" name="status_id" hidden>
                                                <button
                                                    class="hover:bg-[#27272a] w-full px-3 py-2 rounded-md text-left">Approve</button>
                                            </form>
                                            <form action="{{ route('calendar.month.patch', $table_cell['event_id']) }}"
                                                method="POST" class="py-1 m-0">
                                                @csrf
                                                @method('PATCH')
                                                <input type="text" value="3" name="status_id" hidden>
                                                <button
                                                    class="hover:bg-[#27272a] w-full px-3 py-2 rounded-md text-left">Deny</button>
                                            </form>
                                            <form action="{{ route('calendar.month.destroy', $table_cell['event_id']) }}"
                                                method="POST" class="py-1 m-0">
                                                @csrf
                                                @method('Delete')
                                                <button
                                                    class="hover:bg-[#27272a] w-full px-3 py-2 rounded-md text-left">Delete</button>
                                            </form>
                                            <a href=""
                                                class="hover:bg-[#27272a] w-full p-3 rounded-md text-left">Edit</a>
                                        </div>
                                    </div>
                                </div>

                                {{-- <div id="{{ $table_cell['event_id'] }}-modal"
                                    class=" fixed z-10 left-0 top-0 w-full h-full overflow-auto bg-[#18181B]/[0.6] hidden">
                                    <div
                                        class="bg-[#09090b] w-[400px] h-[300px] rounded-lg p-5 border border-[#27272a] mx-auto mt-48">
                                        <div class="flex flex-col gap-1 items-center justify-center">
                                            <form action="" class="m-0">
                                                <button
                                                    class="bg-[#fafafa] text-[#09090b] font-medium rounded-md h-9 text-sm w-[100px]">
                                                    Approve
                                                </button>
                                            </form>
                                            <form action="" class="m-0">
                                                <button
                                                    class="bg-[#fafafa] text-[#09090b] font-medium rounded-md h-9 text-sm w-[100px]">
                                                    Deny
                                                </button>
                                            </form>

                                            <button
                                                class="bg-[#fafafa] text-[#09090b] font-medium rounded-md h-9 text-sm w-[100px]">
                                                Edit
                                            </button>
                                            <button
                                                class="bg-[#fafafa] text-[#09090b] font-medium rounded-md h-9 text-sm w-[100px]"
                                                onclick="close_modal(this)" id="{{ $table_cell['event_id'] }}">
                                                Cancel
                                            </button>
                                        </div>
                                    </div>
                                </div> --}}
                            @endif
                        </div>
                    @endforeach
                </div>
            @endforeach

        </div>



    </div>
    <script>
        function open_menu(value) {
            menu = document.getElementById(value.id + '-menu')
            if (menu.style.display === 'block') {
                menu.style.display = 'none'
            } else {
                menu.style.display = 'block'
            }
        }
    </script>
    <style>
        html:has(.cell-1:hover) .cell-1 {
            border-color: #fafafa;
        }

        html:has(.cell-2:hover) .cell-2 {
            border-color: #fafafa;
        }

        html:has(.cell-3:hover) .cell-3 {
            border-color: #fafafa;
        }

        html:has(.cell-4:hover) .cell-4 {
            border-color: #fafafa;
        }

        html:has(.cell-5:hover) .cell-5 {
            border-color: #fafafa;
        }

        html:has(.cell-6:hover) .cell-6 {
            border-color: #fafafa;
        }

        html:has(.cell-7:hover) .cell-7 {
            border-color: #fafafa;
        }

        html:has(.cell-8:hover) .cell-8 {
            border-color: #fafafa;
        }

        html:has(.cell-9:hover) .cell-9 {
            border-color: #fafafa;
        }

        html:has(.cell-10:hover) .cell-10 {
            border-color: #fafafa;
        }

        html:has(.cell-11:hover) .cell-11 {
            border-color: #fafafa;
        }

        html:has(.cell-12:hover) .cell-12 {
            border-color: #fafafa;
        }

        html:has(.cell-13:hover) .cell-13 {
            border-color: #fafafa;
        }

        html:has(.cell-14:hover) .cell-14 {
            border-color: #fafafa;
        }

        html:has(.cell-15:hover) .cell-15 {
            border-color: #fafafa;
        }

        html:has(.cell-16:hover) .cell-16 {
            border-color: #fafafa;
        }

        html:has(.cell-17:hover) .cell-17 {
            border-color: #fafafa;
        }

        html:has(.cell-18:hover) .cell-18 {
            border-color: #fafafa;
        }

        html:has(.cell-19:hover) .cell-19 {
            border-color: #fafafa;
        }

        html:has(.cell-20:hover) .cell-20 {
            border-color: #fafafa;
        }

        html:has(.cell-21:hover) .cell-21 {
            border-color: #fafafa;
        }

        html:has(.cell-22:hover) .cell-22 {
            border-color: #fafafa;
        }

        html:has(.cell-23:hover) .cell-23 {
            border-color: #fafafa;
        }

        html:has(.cell-24:hover) .cell-24 {
            border-color: #fafafa;
        }

        html:has(.cell-25:hover) .cell-25 {
            border-color: #fafafa;
        }

        html:has(.cell-26:hover) .cell-26 {
            border-color: #fafafa;
        }

        html:has(.cell-27:hover) .cell-27 {
            border-color: #fafafa;
        }

        html:has(.cell-28:hover) .cell-28 {
            border-color: #fafafa;
        }

        html:has(.cell-29:hover) .cell-29 {
            border-color: #fafafa;
        }

        html:has(.cell-30:hover) .cell-30 {
            border-color: #fafafa;
        }

        html:has(.cell-31:hover) .cell-31 {
            border-color: #fafafa;
        }
    </style>
@endsection
