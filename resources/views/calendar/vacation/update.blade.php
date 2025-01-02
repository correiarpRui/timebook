@extends('layouts.layout')

@section('content')
    <div class="text-[#fafafa]">
        <ol class="flex items-center p-2 gap-1">
            <li>
                <a href="{{ route('calendar.vacation', $event[0]->year) }}"
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
                <a href="{{ route('calendar.vacation.update', $event[0]->id) }}">Update vacation</a>
            </li>
        </ol>
        <div class="p-6">
            <div class="text-2xl font-bold tracking-tight text-[#fafafa]">
                Update Vacation
            </div>
            <hr class="my-[12px] border-[#27272a]">
            <form action="{{ route('calendar.vacation.patch', $event[0]->id) }}" method="POST" class="flex flex-col gap-4">
                @csrf
                @method('PATCH')
                <div class="flex flex-col gap-1">
                    <label for="year" class="text-sm font-medium">Name</label>
                    <div
                        class="bg-transparent border border-[#27272a] rounded-md h-9 px-3 py-1 focus:outline-none focus:border-[#e5e7eb]">

                        {{ $event[0]->users[0]->first_name }} {{ $event[0]->users[0]->last_name }}
                    </div>
                </div>
                <div class="flex flex-col gap-1">
                    <label for="year" class="text-sm font-medium">Year</label>
                    <div
                        class="bg-transparent border border-[#27272a] rounded-md h-9 px-3 py-1 focus:outline-none focus:border-[#e5e7eb]">
                        {{ $event[0]->year }}
                    </div>
                </div>
                <div class="flex flex-col gap-1">
                    <label for="year" class="text-sm font-medium">Month</label>
                    <div
                        class="bg-transparent border border-[#27272a] rounded-md h-9 px-3 py-1 focus:outline-none focus:border-[#e5e7eb]">
                        {{ $event[0]->month }}
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
