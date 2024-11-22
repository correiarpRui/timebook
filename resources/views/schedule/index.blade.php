@extends('layouts.layout')

@section('content')
    <div>
        <div class="px-10 pt-10 pb-5">
            <a class="uppercase bg-orange-400 rounded-md px-8 py-1 my-5" href="{{route('schedule.create')}}">New Schedule</a>
        </div>

        <div class="px-10 py-2">
            <table class="border-collapse w-full [&>tbody>*:nth-child(odd)]:bg-white">
                <tr>
                    <th class="border border-gray-400 text-left p-2">Name</th>
                    <th class="border border-gray-400 text-left p-2">Morning Start</th>
                    <th class="border border-gray-400 text-left p-2">Morning End</th>
                    <th class="border border-gray-400 text-left p-2">Afternoon Start</th>
                    <th class="border border-gray-400 text-left p-2">Afternoon End</th>
                    <th class="border border-gray-400 text-left p-2">Working Days</th>
                    <th class="border border-gray-400 text-left p-2">Actions</th>
                </tr>
                @foreach ($schedules as $schedule)
                    <tr>
                        <td class="border border-gray-400 text-left p-2">{{ $schedule->name }}</td>
                        <td class="border border-gray-400 text-left p-2">{{ $schedule->morning_start }}</td>
                        <td class="border border-gray-400 text-left p-2">{{ $schedule->morning_end }}</td>
                        <td class="border border-gray-400 text-left p-2">{{ $schedule->afternoon_start }}</td>
                        <td class="border border-gray-400 text-left p-2">{{ $schedule->afternoon_end }}</td>
                        <td class="border border-gray-400 text-left p-2">
                            {{ $schedule->monday ? 'Mon' : '' }}
                            {{ $schedule->tuesday ? 'Tue' : '' }}
                            {{ $schedule->wednesday ? 'Wen' : '' }}
                            {{ $schedule->thursday ? 'Thu' : '' }}
                            {{ $schedule->friday ? 'Fri' : '' }}
                            {{ $schedule->saturday ? 'Sat' : '' }}
                            {{ $schedule->sunday ? 'Sun' : '' }}
                        </td>
                        <td class="border border-gray-400 text-left p-2">
                            <div class="flex gap-2">
                                <a href="{{ route('schedule.update', $schedule->id) }}">Update</a>
                                <form action="{{ route('schedule.destroy', $schedule->id) }}" method="POST">
                                    @method('delete')
                                    @csrf
                                    <button>Delete</button>
                                </form>
                            </div>
                        </td>
                    </tr>
                @endforeach
            </table>
        </div>
    </div>
@endsection
