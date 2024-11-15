@extends('layouts.layout')

@section('content')
    <div>
        <div class="px-10 pt-10 pb-5">
            <a class="uppercase bg-orange-400 rounded-md px-8 py-1 my-5" href="/record/create">New Record</a>
        </div>

        <div class="px-10 py-2">
            <table class="border-collapse w-full [&>tbody>*:nth-child(odd)]:bg-white">
                <tr>
                    <th class="border border-gray-400 text-left p-2">Date</th>
                    <th class="border border-gray-400 text-left p-2">Week Day</th>
                    <th class="border border-gray-400 text-left p-2">User Name</th>
                    <th class="border border-gray-400 text-left p-2">Morning Start</th>
                    <th class="border border-gray-400 text-left p-2">Morning End</th>
                    <th class="border border-gray-400 text-left p-2">Afternoon Start</th>
                    <th class="border border-gray-400 text-left p-2">Afternoon End</th>
                    <th class="border border-gray-400 text-left p-2">Presence</th>
                    <th class="border border-gray-400 text-left p-2">Actions</th>
                </tr>
                @foreach ($records as $record)
                    <tr>
                        <td class="border border-gray-400 text-left p-2">{{ $record->date }}</td>
                        <td class="border border-gray-400 text-left p-2">{{ $record->week_day }}</td>
                        <td class="border border-gray-400 text-left p-2">{{ $record->user->name }}</td>
                        <td class="border border-gray-400 text-left p-2">{{ $record->morning_start }}</td>
                        <td class="border border-gray-400 text-left p-2">{{ $record->morning_end }}</td>
                        <td class="border border-gray-400 text-left p-2">{{ $record->afternoon_start }}</td>
                        <td class="border border-gray-400 text-left p-2">{{ $record->afternoon_end }}</td>
                        <td class="border border-gray-400 text-left p-2">{{ $record->is_present ? 'True' : 'False' }}</td>
                        <td class="border border-gray-400 text-left p-2">
                            <div class="flex gap-2">
                                <a href="{{ route('record.show', $record->id) }}">View</a>
                            </div>
                        </td>
                    </tr>
                @endforeach
            </table>
        </div>
    </div>
@endsection
