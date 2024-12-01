@extends('layouts.layout')

@section('content')
    <div class="text-[#fafafa] p-6">
        <div class="flex justify-between">
            <div class="text-2xl font-bold tracking-tight text-[#fafafa]">Schedules</div>
            <a class="bg-[#fafafa] text-[#09090b] flex items-center gap-2 rounded-md px-4 py-2 cursor-pointer text-sm font-medium"
                href="{{ route('schedule.create') }}">
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none"
                    stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                    class="lucide lucide-circle-plus ">
                    <circle cx="12" cy="12" r="10"></circle>
                    <path d="M8 12h8"></path>
                    <path d="M12 8v8"></path>
                </svg>
                Add schedule
            </a>
        </div>
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
                                        Morning start
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
                                        Morning End
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
                                        Afternoon start
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
                                        Afternoon end
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
                                        Working days
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
                    @foreach ($schedules as $schedule)
                        <tr class="border border-b border-[#27272a] hover:bg-[#27272a]/50">
                            <td class="h-10 px-5 text-left align-middle font-medium">{{ $schedule->name }}</td>
                            <td class="h-10 px-5 text-left align-middle font-medium">{{ $schedule->morning_start }}
                            </td>
                            <td class="h-10 px-5 text-left align-middle font-medium">{{ $schedule->morning_end }}</td>
                            <td class="h-10 px-5 text-left align-middle font-medium">{{ $schedule->afternoon_start }}
                            </td>
                            <td class="h-10 px-5 text-left align-middle font-medium">{{ $schedule->afternoon_end }}
                            </td>
                            <td class="h-10 px-5 text-left align-middle font-medium">
                                {{ $schedule->monday ? 'Mon' : '' }}
                                {{ $schedule->tuesday ? 'Tue' : '' }}
                                {{ $schedule->wednesday ? 'Wen' : '' }}
                                {{ $schedule->thursday ? 'Thu' : '' }}
                                {{ $schedule->friday ? 'Fri' : '' }}
                                {{ $schedule->saturday ? 'Sat' : '' }}
                                {{ $schedule->sunday ? 'Sun' : '' }}
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
                                        <a href="{{ route('schedule.update', $schedule->id) }}"
                                            class="rounded-md my-1 mx-2 py-2 px-2 text-[#fafafa] flex items-center gap-1 hover:bg-[#27272a]">Edit</a>
                                        <form action="{{ route('schedule.destroy', $schedule->id) }}" method="POST"
                                            class="mr-4">
                                            @method('delete')
                                            @csrf
                                            <button
                                                class="rounded-md my-1 mx-2 py-2 px-2 text-[#DC2626] flex items-center gap-1 hover:bg-[#27272a] w-full">Delete</button>
                                        </form>
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
