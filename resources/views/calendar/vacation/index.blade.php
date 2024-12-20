@extends('layouts.layout')

@section('content')
    <div class="text-[#fafafa] p-6">
        <div class="text-2xl font-bold tracking-tight text-[#fafafa]">Vacations</div>
        <hr class="my-[24px] border-[#27272a]">
        <div class="border rounded-md border-[#27272a]">
            <table class="text-sm w-full border border-b border-[#27272a]">
                <thead>
                    <tr class="border border-b border-[#27272a] hover:bg-[#27272a]/50">
                        <th class="h-10 px-2 text-left align-middle font-medium">
                            <div class="flex items-center">
                                <button class="flex items-center gap-2 px-3 py-1 rounded-md hover:bg-[#27272a]">
                                    <span>
                                        Name
                                    </span>
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24"
                                        fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                        stroke-linejoin="round" class="lucide lucide-chevrons-up-down ">
                                        <path d="m7 15 5 5 5-5"></path>
                                        <path d="m7 9 5-5 5 5"></path>
                                    </svg>
                                </button>
                            </div>
                        </th>
                        <th class="h-10 px-2 text-left align-middle font-medium">
                            <div class="flex items-center">
                                <button class="flex items-center gap-2 px-3 py-1 rounded-md hover:bg-[#27272a]">
                                    <span>
                                        Start Date
                                    </span>
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                        viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                        stroke-linecap="round" stroke-linejoin="round"
                                        class="lucide lucide-chevrons-up-down ">
                                        <path d="m7 15 5 5 5-5"></path>
                                        <path d="m7 9 5-5 5 5"></path>
                                    </svg>
                                </button>
                            </div>
                        </th>
                        <th class="h-10 px-2 text-left align-middle font-medium">
                            <div class="flex items-center">
                                <button class="flex items-center gap-2 px-3 py-1 rounded-md hover:bg-[#27272a]">
                                    <span>
                                        End Date
                                    </span>
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                        viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                        stroke-linecap="round" stroke-linejoin="round"
                                        class="lucide lucide-chevrons-up-down ">
                                        <path d="m7 15 5 5 5-5"></path>
                                        <path d="m7 9 5-5 5 5"></path>
                                    </svg>
                                </button>
                            </div>
                        </th>
                        <th class="h-10 px-2 text-left align-middle font-medium">
                            <div class="flex items-center">
                                <button class="flex items-center gap-2 px-3 py-1 rounded-md hover:bg-[#27272a]">
                                    <span>
                                        Days
                                    </span>
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                        viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                        stroke-linecap="round" stroke-linejoin="round"
                                        class="lucide lucide-chevrons-up-down ">
                                        <path d="m7 15 5 5 5-5"></path>
                                        <path d="m7 9 5-5 5 5"></path>
                                    </svg>
                                </button>
                            </div>
                        </th>
                        <th class="h-10 px-2 text-left align-middle font-medium">
                            <div class="flex items-center">
                                <button class="flex items-center gap-2 px-3 py-1 rounded-md hover:bg-[#27272a]">
                                    <span>
                                        Year
                                    </span>
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                        viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                        stroke-linecap="round" stroke-linejoin="round"
                                        class="lucide lucide-chevrons-up-down ">
                                        <path d="m7 15 5 5 5-5"></path>
                                        <path d="m7 9 5-5 5 5"></path>
                                    </svg>
                                </button>
                            </div>
                        </th>
                        <th class="h-10 px-2 text-left align-middle font-medium">
                            <div class="flex items-center">
                                <button class="flex items-center gap-2 px-3 py-1 rounded-md hover:bg-[#27272a]">
                                    <span>
                                        Status
                                    </span>
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                        viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                        stroke-linecap="round" stroke-linejoin="round"
                                        class="lucide lucide-chevrons-up-down ">
                                        <path d="m7 15 5 5 5-5"></path>
                                        <path d="m7 9 5-5 5 5"></path>
                                    </svg>
                                </button>
                            </div>
                        </th>
                        <th class="h-10 px-2 text-left align-middle font-medium w-16"></th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($events as $event)
                        <tr class="border border-b border-[#27272a] hover:bg-[#27272a]/50">
                            <td class="h-10 px-5 text-left align-middle font-medium">{{ $event->users[0]['first_name'] }}
                                {{ $event->users[0]['last_name'] }}</td>
                            <td class="h-10 px-5 text-left align-middle font-medium">{{ $event->start_date }}</td>
                            <td class="h-10 px-5 text-left align-middle font-medium">{{ $event->end_date }}</td>
                            <td class="h-10 px-5 text-left align-middle font-medium">
                                {{ $event->end_day - $event->start_day + 1 }}
                            </td>
                            <td class="h-10 px-5 text-left align-middle font-medium">{{ $event->year }}</td>
                            <td class="h-10 px-5 text-left align-middle font-medium">
                                @if ($event->status_id == 1)
                                    Pending
                                @elseif ($event->status_id == 2)
                                    Approved
                                @else
                                    Denied
                                @endif
                            </td>
                            <td class="h-10 px-5 text-left align-middle font-medium relative">
                                <button class="flex items-center gap-2 px-3 py-1 rounded-md hover:bg-[#27272a] w-10"
                                    onclick=toggleSubMenuDropDown(this)>
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                        viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                        stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-ellipsis ">
                                        <circle cx="12" cy="12" r="1"></circle>
                                        <circle cx="19" cy="12" r="1"></circle>
                                        <circle cx="5" cy="12" r="1"></circle>
                                    </svg>
                                </button>
                                <ul
                                    class="grid submenu_options z-50 absolute left-[-90px] rounded-md w-[150px] bg-[#09090b]">
                                    <div class=" overflow-hidden">
                                        <form action="{{ route('calendar.vacation.patch', $event->id) }}" method="POST"
                                            class="mr-4">
                                            @csrf
                                            @method('PATCH')
                                            <input type="text" value="2" name="status_id" hidden>
                                            <button
                                                class="rounded-md my-1 mx-2 py-2 px-2 flex items-center gap-1 hover:bg-[#27272a] w-full">Approve</button>
                                        </form>
                                        <form action="{{ route('calendar.vacation.destroy', $event->id) }}" method="POST"
                                            class="mr-4">
                                            @csrf
                                            @method('Delete')
                                            <button
                                                class="rounded-md my-1 mx-2 py-2 px-2 flex items-center gap-1 hover:bg-[#27272a] w-full">Delete</button>
                                        </form>
                                        <a href="{{ route('calendar.vacation.update', $event->id) }}"
                                            class="rounded-md my-1 mx-2 py-2 px-2 text-[#fafafa] flex items-center gap-1 hover:bg-[#27272a]">Edit</a>
                                    </div>
                                </ul>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection
