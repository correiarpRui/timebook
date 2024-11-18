@extends('layouts.layout')

@section('content')
    <div class="py-10 px-5 w-full">
        <div class="uppercase text-2xl font-semibold ">Calendar {{ $year }}</div>
        <hr class="border-black border-[1px] mt-1 mb-5">
        <div class="bg-white">
            <table class="border-collapse w-full [&>tbody>*:nth-child(odd)]:bg-white">
                <tr>
                    <th class="border border-gray-400 text-left p-2">Month</th>
                    <th class="border border-gray-400 text-left p-2">Sun</th>
                    <th class="border border-gray-400 text-left p-2">Mon</th>
                    <th class="border border-gray-400 text-left p-2">Tue</th>
                    <th class="border border-gray-400 text-left p-2">Wed</th>
                    <th class="border border-gray-400 text-left p-2">Thu</th>
                    <th class="border border-gray-400 text-left p-2">Fri</th>
                    <th class="border border-gray-400 text-left p-2">Sat</th>
                    <th class="border border-gray-400 text-left p-2">Sun</th>
                    <th class="border border-gray-400 text-left p-2">Mon</th>
                    <th class="border border-gray-400 text-left p-2">Tue</th>
                    <th class="border border-gray-400 text-left p-2">Wed</th>
                    <th class="border border-gray-400 text-left p-2">Thu</th>
                    <th class="border border-gray-400 text-left p-2">Fri</th>
                    <th class="border border-gray-400 text-left p-2">Sat</th>
                    <th class="border border-gray-400 text-left p-2">Sun</th>
                    <th class="border border-gray-400 text-left p-2">Mon</th>
                    <th class="border border-gray-400 text-left p-2">Tue</th>
                    <th class="border border-gray-400 text-left p-2">Wed</th>
                    <th class="border border-gray-400 text-left p-2">Thu</th>
                    <th class="border border-gray-400 text-left p-2">Fri</th>
                    <th class="border border-gray-400 text-left p-2">Sat</th>
                    <th class="border border-gray-400 text-left p-2">Sun</th>
                    <th class="border border-gray-400 text-left p-2">Mon</th>
                    <th class="border border-gray-400 text-left p-2">Tue</th>
                    <th class="border border-gray-400 text-left p-2">Wed</th>
                    <th class="border border-gray-400 text-left p-2">Thu</th>
                    <th class="border border-gray-400 text-left p-2">Fri</th>
                    <th class="border border-gray-400 text-left p-2">Sat</th>
                    <th class="border border-gray-400 text-left p-2">Sun</th>
                    <th class="border border-gray-400 text-left p-2">Mon</th>
                    <th class="border border-gray-400 text-left p-2">Tue</th>
                    <th class="border border-gray-400 text-left p-2">Wed</th>
                    <th class="border border-gray-400 text-left p-2">Thu</th>
                    <th class="border border-gray-400 text-left p-2">Fri</th>
                    <th class="border border-gray-400 text-left p-2">Sat</th>
                </tr>

                <x-calendar :year="$year" />


            </table>



        </div>
    </div>
@endsection
