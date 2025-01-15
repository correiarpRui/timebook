@extends('layouts.testlayout')

@section('content')
    {{-- border-[#eff0f6] --}}
    <div class="px-6">
        <div class=" border rounded-md bg-white my-6">
            <div class="border-b flex justify-between p-4 items-center">
                <p class="font-semibold text-xl">{{ $month_name }} {{ $year }}</p>
                <div class="flex gap-3">
                    <a href="{{ route('calendar.month', $month == 1 ? [$year - 1, 12] : [$year, $month - 1]) }}"
                        class="flex items-center justify-center border p-2 rounded-md gap-2 hover:bg-[#eff0f6] w-[75px]">
                        <span>previous</span></a>
                    <a href="{{ route('calendar.month', $month == 12 ? [$year + 1, 1] : [$year, $month + 1]) }}"
                        class="flex items-center justify-center border p-2 rounded-md gap-2 hover:bg-[#eff0f6] w-[75px]">
                        <span>next</span></a>
                </div>
            </div>
            <div class="mx-6 pt-6 pb-[150px] overflow-auto">
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
                            
                        @if ($table_cell['today']) bg-[#ff7f31]/[0.8] text-white
                        @elseif ($table_cell['holiday'])  bg-[#92CD28]/[0.6]
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
                        @if ($table_cell['today']) bg-[#ff7f31]/[0.8] text-white
                        @elseif ($table_cell['holiday'])  bg-[#92CD28]/[0.6]
                        @elseif (!$table_cell['weekday'])  bg-[#DFE2E4]
                        @else bg-transparent @endif">
                            {{ $table_cell['week_day'] }}
                        </div>
                    @endforeach
                </div>
                @foreach ($table_data['users'] as $user)
                    <div @if ($days_in_month + 1 == 29) class="grid grid-cols-29" @endif
                        @if ($days_in_month + 1 == 30) class="grid grid-cols-30" @endif
                        @if ($days_in_month + 1 == 31) class="grid grid-cols-31" @endif
                        @if ($days_in_month + 1 == 32) class="grid grid-cols-32" @endif>
                        <div class="border border-t-[0px] flex justify-center items-center font-semibold">
                            {{ $user['user_info']['name'] }}
                        </div>
                        @foreach ($user['data'] as $table_cell)
                            <div
                                class="cell-{{ $table_cell['day'] }} text-center h-12 py-2 border border-l-[0px] border-t-[0px]
                            @if ($table_cell['today']) bg-[#ff7f31]/[0.8] text-white
                            @elseif ($table_cell['holiday'])  bg-[#92CD28]/[0.6]
                            @elseif (!$table_cell['weekday'])  bg-[#DFE2E4]
                            @else bg-transparent @endif">
                                @if (array_key_exists('start', $table_cell))
                                    <div class="vacation_menu_open relative z-10 bg-[#e88c30] rounded-full h-[26px] mt-[2px] flex justify-center gap-1 items-center cursor-pointer"
                                        style="width: calc({{ $table_cell['range'] }}*100% + ({{ $table_cell['range'] }}px - 1px)"
                                        onclick=open_menu(this) id="{{ $table_cell['event_id'] }}">
                                        @if ($table_cell['status_id'] == 1)
                                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                                viewBox="0 0 24 24" fill="#fa0000" stroke="#fafafa" stroke-width="3"
                                                stroke-linecap="round" stroke-linejoin="round"
                                                class="lucide lucide-circle-alert pointer-events-none">
                                                <circle cx="12" cy="12" r="10" stroke="#fa0000"
                                                    stroke-width="0" />
                                                <line x1="12" x2="12" y1="8" y2="12" />
                                                <line x1="12" x2="12.01" y1="16" y2="16" />
                                            </svg>
                                        @endif
                                        @if ($table_cell['status_id'] == 2)
                                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                                viewBox="0 0 24 24" fill="currentColor" stroke="#e88c30" stroke-width="3"
                                                stroke-linecap="round" stroke-linejoin="round"
                                                class="lucide lucide-circle-check pointer-events-none">
                                                <circle cx="12" cy="12" r="10" stroke-width="0" />
                                                <path d="m9 12 2 2 4-4" />
                                            </svg>
                                        @endif
                                        @if ($table_cell['range'] != 1)
                                            <span class="text-md font-semibold pointer-events-none">Vacation</span>
                                        @endif

                                        <div class="vacation_menu grid z-50 absolute top-[25px] left-0 rounded-md w-[150px] border-[#eff0f6] bg-white text-sm font-medium"
                                            id="{{ $table_cell['event_id'] }}-vacation_menu">
                                            <div class="overflow-hidden">
                                                @if ($table_cell['range'] == 1)
                                                    <div class="text-center font-semibold mt-2">Vacation,
                                                        {{ $table_cell['range'] }}
                                                        day</div>
                                                @else
                                                    <div class="text-center font-semibold mt-2">Vacation,
                                                        {{ $table_cell['range'] }}
                                                        days</div>
                                                @endif
                                                <hr class="mt-2 border-[#eff0f6] ">
                                                @if ($table_cell['status_id'] == 1)
                                                    <form
                                                        action="{{ route('calendar.vacation.approve', $table_cell['event_id']) }}"
                                                        method="POST">
                                                        @csrf
                                                        @method('PATCH')
                                                        <input type="text" value="2" name="status_id" hidden>
                                                        <button
                                                            class="flex w-full items-center py-2 px-2 gap-1 hover:bg-[#eff0f6]">
                                                            <svg xmlns="http://www.w3.org/2000/svg" width="16"
                                                                height="16" viewBox="0 0 24 24" fill="none"
                                                                stroke="currentColor" stroke-width="2"
                                                                stroke-linecap="round" stroke-linejoin="round"
                                                                class="lucide lucide-check ml-2">
                                                                <path d="M20 6 9 17l-5-5" />
                                                            </svg>
                                                            <span>Aprove</span>
                                                        </button>
                                                    </form>
                                                @endif
                                                <a href="{{ route('calendar.vacation.update', $table_cell['event_id']) }}"
                                                    class="py-2 px-2 flex items-center gap-2 hover:bg-[#eff0f6]">
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                                        viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                                        stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                                                        class="lucide lucide-file-pen-line ml-2">
                                                        <path
                                                            d="m18 5-2.414-2.414A2 2 0 0 0 14.172 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2" />
                                                        <path
                                                            d="M21.378 12.626a1 1 0 0 0-3.004-3.004l-4.01 4.012a2 2 0 0 0-.506.854l-.837 2.87a.5.5 0 0 0 .62.62l2.87-.837a2 2 0 0 0 .854-.506z" />
                                                        <path d="M8 18h1" />
                                                    </svg>
                                                    <span>Edit</span>
                                                </a>
                                                <form
                                                    action="{{ route('calendar.vacation.destroy', $table_cell['event_id']) }}"
                                                    method="POST">
                                                    @csrf
                                                    @method('Delete')
                                                    <button
                                                        class="py-2 px-2 flex items-center gap-1 hover:bg-[#eff0f6] w-full">
                                                        <svg xmlns="http://www.w3.org/2000/svg" width="16"
                                                            height="16" viewBox="0 0 24 24" fill="none"
                                                            stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                                            stroke-linejoin="round" class="lucide lucide-trash ml-2">
                                                            <path d="M3 6h18" />
                                                            <path d="M19 6v14c0 1-1 2-2 2H7c-1 0-2-1-2-2V6" />
                                                            <path d="M8 6V4c0-1 1-2 2-2h4c1 0 2 1 2 2v2" />
                                                        </svg>
                                                        <span>Delete</span>
                                                    </button>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                @endif
                            </div>
                        @endforeach
                    </div>
                @endforeach
            </div>
        </div>
    </div>
    <script>
        function open_menu(value) {
            menus = document.querySelectorAll('.vacation_menu')
            current_menu = document.getElementById(value.id + '-vacation_menu')

            menus.forEach(menu => {
                if (menu == current_menu) {
                    if (current_menu.classList.contains('show')) {
                        current_menu.classList.remove('show')
                    } else {
                        current_menu.classList.add('show')
                    }
                } else {
                    menu.classList.remove('show')
                }
            });
        }

        window.onclick = function(event) {
            menus = document.querySelectorAll('.vacation_menu')
            if (!event.target.classList.contains('vacation_menu_open')) {
                menus.forEach(menu => {
                    menu.classList.remove('show')
                });
            }

        }
    </script>
@endsection
