@extends('layouts.layout')

@section('content')
    <div class="text-[#fafafa] p-2">

        <div class="border border-[#fafafa] flex flex-col">
            <div class="col-span-2 border border-[#fafafa] p-2 flex justify-between items-center">
                <div class="text-xl font-semibold">Schedule planner {{ $year }}</div>
                <div class="flex gap-2">
                    <a href="" class="bg-[#fafafa] p-2 rounded-md">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24"
                            fill="none" stroke="#09090b" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                            class="lucide lucide-chevron-left">
                            <path d="m15 18-6-6 6-6" />
                        </svg>
                    </a>
                    <a href="" class="bg-[#fafafa] p-2 rounded-md">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24"
                            fill="none" stroke="#09090b" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                            class="lucide lucide-chevron-right">
                            <path d="m9 18 6-6-6-6" />
                        </svg>
                    </a>
                </div>
            </div>
            @foreach ($users as $user)
                <div class="grid grid-cols-2">
                    <div class="border border-[#fafafa] p-2">
                        <div>{{ $user->first_name }} {{ $user->last_name }}</div>
                    </div>
                    <div class="border border-[#fafafa] p-2">Planner</div>
                </div>
            @endforeach

        </div>

    </div>
@endsection
