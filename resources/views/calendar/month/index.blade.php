@extends('layouts.layout')

@section('content')
    <div class="text-[#fafafa] p-6">

        <table class="text-sm border border-b border-[#27272a] text-[#fafafa]">
            <colgroup>
                @foreach ($table_data['month']['day'] as $table_cell)
                    @if ($table_cell == 'S')
                        <col span="1" class="weekend">
                    @else
                        <col span="1">
                    @endif
                @endforeach
            </colgroup>
            <thead>
                <tr>
                    @foreach ($table_data['month']['date'] as $table_cell)
                        <th class="text-center font-medium">
                            <div>{{ $table_cell }}</div>
                        </th>
                    @endforeach
                </tr>
                <tr>
                    @foreach ($table_data['month']['day'] as $table_cell)
                        <th class="text-center font-medium">
                            <div>{{ $table_cell }}
                            </div>
                        </th>
                    @endforeach
                </tr>
            </thead>
            <tbody>
                @foreach ($table_data['users'] as $user)
                    <tr>
                        <td class="text-center font-medium">
                            {{ $user['user_info']['name'] }}
                        </td>
                        @foreach ($user['data'] as $table_cell)
                            <td
                                @if ($table_cell['event'] == 'vacation') class="text-center font-medium rounded-full bg-[#fafafa]"
                            @else class="text-[#323232] text-center font-medium" @endif>
                                <div
                                    class="@if ($table_cell['event'] == 'vacation') bg-[#fafafa] text-[#09090b] rounded-full @endif">
                                    {{ $table_cell['day'] }}</div>
                            </td>
                        @endforeach
                    </tr>
                @endforeach

            </tbody>

        </table>

    </div>
@endsection

<style>
    table {
        overflow: hidden;
        table-layout: auto;
        width: 100%;
    }

    td:nth-child(1) {
        width: 200px
    }

    td,
    th {
        position: relative;
        padding: 1rem;
        border-top: 1px solid #27272a;
        border-bottom: 1px solid #27272a;
    }


    td:hover::after {
        background-color: rgb(39 39 42 / 0.75);
        content: '';
        height: 10000px;
        left: 0;
        position: absolute;
        top: -5000px;
        width: 100%;
        z-index: -1;
    }
</style>
