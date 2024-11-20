@extends('layouts.layout')

@section('content')
    <div class="py-10 px-5 w-full">
        <div class="flex justify-between">
            <div class="uppercase text-2xl font-semibold my-2">Calendar {{ $year }}</div>
            <div class="flex gap-3">
                <a class="uppercase bg-orange-400 rounded-md px-8 py-1 my-2"
                    href="{{ route('calendar', $year - 1) }}">Previous
                </a>
                <a class="uppercase bg-orange-400 rounded-md px-8 py-1 my-2" href="{{ route('calendar', $year + 1) }}">Next
                </a>
            </div>
        </div>

        <hr class="border-black border-[1px] mt-1 mb-5">
        <div class="bg-white">
            <table class="border-collapse w-full select-none [&>tbody>*:nth-child(odd)]:bg-white">
                <tr class="h-[40px]">
                    @foreach ($calendar_total_rows['weeks'] as $cell)
                        <th class="border border-gray-400 text-center w-[40px]">
                            {{ $cell }}
                        </th>
                    @endforeach
                </tr>
                <form action="{{ route('calendar.store', $year) }}" method="POST" id="calendar_form">
                    @csrf
                    @foreach ($calendar_total_rows['months'] as $month_row)
                        <tr class="h-[40px]">
                            @foreach ($month_row as $key => $cell)
                                <td
                                    class='border border-gray-400 text-center w-[40px]
                                @if ($cell['attributes'] == 'holiday') bg-orange-200 @endif 
                                @if ($cell['attributes'] == 'today') bg-orange-400 @endif
                                @if (in_array($key, [1, 7, 8, 14, 15, 21, 22, 28, 29, 35, 36, 42])) bg-gray-300 @endif'>
                                    @if ($cell['date'])
                                        <input type="checkbox" class="hidden peer" id="{{ $cell['date'] }}"
                                            value="{{ $cell['date'] }}" name="{{ $cell['date'] }}">
                                        <label for="{{ $cell['date'] }}"
                                            class=" w-[40px] h-full py-[8px] align-middle inline-block  peer-checked:bg-red-600">{{ $cell['value'] }}
                                        </label>
                                    @else
                                        {{ $cell['value'] }}
                                    @endif
                                </td>
                            @endforeach
                        </tr>
                    @endforeach
                </form>
            </table>
        </div>
        <button class="uppercase bg-orange-400 rounded-md px-8 py-1 my-2" type="submit"
            form="calendar_form">Submit</button>

    </div>
@endsection
