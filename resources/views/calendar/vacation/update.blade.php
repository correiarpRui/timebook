@extends('layouts.layout')

@section('content')
    <div class="text-[#fafafa]">
        <ol class="flex items-center p-2 gap-1">
            <li>
                <a href="{{ route('calendar.vacation', $event->year) }}"
                    class="text-[#a1a1aa] hover:text-[#fafafa]">Vacation</a>
            </li>
            <li>
                <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 21 21" fill="none"
                    stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                    class="lucide lucide-chevron-right text-[#a1a1aa]">
                    <path d="m9 18 6-6-6-6"></path>
                </svg>
            </li>
            <li>
                <a href="{{ route('calendar.vacation.update', $event->id) }}">Update vacation</a>
            </li>
        </ol>
        <div class="p-6">
            <div class="text-2xl font-bold tracking-tight text-[#fafafa]">
                Update Vacation
            </div>
            <hr class="my-[12px] border-[#27272a]">
            <form action="{{ route('calendar.vacation.patch', $event->id) }}" method="POST" class="flex flex-col gap-4">
                @csrf
                @method('PATCH')
                <div>
                    <label for="last_name" class="text-sm font-medium">Year</label>
                    <button
                        class="bg-transparent border border-[#27272a] rounded-md h-9 px-3 flex justify-between items-center gap-2 w-[100px]"
                        type="button" onclick=toggleSubMenuDropDown(this)>
                        <span id="button_year_label" class="text-[#9ca3af]">year</span>
                        <svg class="flex-shrink-0" xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                            viewBox="0 0 24 24" fill="none" stroke="#9ca3af" stroke-width="2" stroke-linecap="round"
                            stroke-linejoin="round" class="lucide lucide-chevron-down ">
                            <path d="m6 9 6 6 6-6"></path>
                        </svg>
                    </button>
                    <div class="bg-[#09090b] rounded-md px-1 grid submenu_options absolute">
                        <div class="overflow-hidden">
                            @for ($i = date('Y'); $i < date('Y') + 5; $i++)
                                <div class="flex items-center hover:bg-[#27272a] px-3 rounded-md w-[90px]">
                                    <input type="radio" name="year" id="year_{{ $i }}"
                                        value="{{ $i }}" class="peer hidden">
                                    <label for="year_{{ $i }}" class="grow cursor-pointer py-1 select-none"
                                        value="{{ $i }}" onclick=get_year(this)>{{ $i }}</label>
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                        viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                        stroke-linecap="round" stroke-linejoin="round"
                                        class="lucide lucide-check opacity-100 m-auto  hidden peer-checked:block">
                                        <path d="M20 6 9 17l-5-5"></path>
                                    </svg>
                                </div>
                            @endfor
                        </div>
                    </div>
                </div>

        </div>
    </div>

    {{--                     
                    'start_date'=> $start_date ? $start_date->format('d-m-Y') : $start_date, 
                    'end_date'=>$end_date ? $end_date->format('d-m-Y') : $end_date,
                    'start_day'=> $start_date ? $start_date->format('d') : $start_date,
                    'end_day'=> $end_date ? $end_date->format('d') : $end_date,
                    'month'=> $start_date ? $start_date->format('m') : $start_date,
                    'year'=> $year,
                    'status_id'=>1, --}}
@endsection
