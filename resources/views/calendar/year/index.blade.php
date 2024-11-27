@extends('layouts.layout')

@section('content')
    <div class="py-10 px-5 w-full">
        <div class="flex justify-between">
            <div class="uppercase text-2xl font-semibold my-2">Calendar {{ $year }}</div>
            <div class="flex gap-3">
                <a class="uppercase bg-orange-400 rounded-md px-8 py-1 my-2"
                    href="{{ route('calendar.year', $year - 1) }}">Previous
                </a>
                <a class="uppercase bg-orange-400 rounded-md px-8 py-1 my-2"
                    href="{{ route('calendar.year', $year + 1) }}">Next
                </a>
            </div>
        </div>

        <hr class="border-black border-[1px] mt-1 mb-5">
        <div class="bg-white">
            <table class="border-collapse w-full select-none [&>tbody>*:nth-child(odd)]:bg-white">
                <tr class="py-4">
                    @foreach ($first_row as $key => $cell)
                        <th
                            class="border border-gray-400 text-center
                            @if (in_array($key, [1, 7, 8, 14, 15, 21, 22, 28, 29, 35, 36, 42])) bg-gray-300 @endif">
                            {{ $cell }}</th>
                    @endforeach
                </tr>
                <form action="{{ route('calendar.store', $year) }}" method="POST" id="calendar_form">
                    @csrf
                    @foreach ($calendar_months as $month)
                        <tr>
                            @foreach ($month as $key => $cell)
                                <td
                                    class='border border-gray-400 text-center
                                    @if (array_key_exists('holiday', $cell)) bg-orange-200 @endif 
                                    @if (array_key_exists('today', $cell)) bg-orange-400 @endif
                                    @if (in_array($key, [1, 7, 8, 14, 15, 21, 22, 28, 29, 35, 36, 42])) bg-gray-300 @endif
                                    @if (array_key_exists('vacation', $cell)) bg-blue-200 @endif'>
                                    @if (array_key_exists('id', $cell))
                                        <input type="checkbox" class="hidden peer" id="{{ $cell['id'] }}"
                                            value="{{ $cell['id'] }}" name="{{ $cell['id'] }}">
                                        <label for="{{ $cell['id'] }}"
                                            class=" w-[20px] h-full py-[8px] align-middle inline-block  peer-checked:bg-red-600">{{ $cell['value'] }}
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
    @endsection
