@extends('layouts.testlayout')

@section('content')
@section('content')
    <div class="px-6">
        <div class=" border rounded-md bg-white mb-6 mt-6">
            <div class="border-b flex justify-between p-5 items-center">
                <p class="font-semibold text-lg">Schedules</p>
                <a href="{{ route('schedule.create') }}"
                    class="flex items-center border p-2 rounded-md gap-2 hover:bg-[#eff0f6]">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none"
                        stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                        class="lucide lucide-circle-plus">
                        <circle cx="12" cy="12" r="10"></circle>
                        <path d="M8 12h8"></path>
                        <path d="M12 8v8"></path>
                    </svg><span class="h-7">Add schedule</span></a>
            </div>
            <div class="p-5">
                <table class="w-full text-left">
                    <thead>
                        <tr class="h-10 border rounded-sm">
                            <th>
                                <button class="flex items-center justify-between w-full px-2 ">
                                    <span class="text-sm font-semibold h-6 text-[#454e60]">
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
                            </th>
                            <th>
                                <button class="flex items-center justify-between w-full px-2 ">
                                    <span class="text-sm font-semibold h-6 text-[#454e60]">
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
                            </th>
                            <th>
                                <button class="flex items-center justify-between w-full px-2 ">
                                    <span class="text-sm font-semibold h-6 text-[#454e60]">
                                        Morning end
                                    </span>
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                        viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                        stroke-linecap="round" stroke-linejoin="round"
                                        class="lucide lucide-chevrons-up-down ">
                                        <path d="m7 15 5 5 5-5"></path>
                                        <path d="m7 9 5-5 5 5"></path>
                                    </svg>
                                </button>
                            </th>
                            <th>
                                <button class="flex items-center justify-between w-full px-2 ">
                                    <span class="text-sm font-semibold h-6 text-[#454e60]">
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
                            </th>
                            <th>
                                <button class="flex items-center justify-between w-full px-2 ">
                                    <span class="text-sm font-semibold h-6 text-[#454e60]">
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
                            </th>
                            <th>
                                <button class="flex items-center justify-between w-full px-2 ">
                                    <span class="text-sm font-semibold h-6 text-[#454e60]">
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
                            </th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($schedules as $schedule)
                            <tr class="border  hover:bg-[#f4f5f7]/80">
                                <td class="h-10 px-2 text-left font-medium">{{ $schedule->name }}</td>
                                <td class="h-10 px-2 text-left font-medium">{{ $schedule->morning_start }}</td>
                                <td class="h-10 px-2 text-left font-medium">{{ $schedule->morning_end }}</td>
                                <td class="h-10 px-2 text-left font-medium">{{ $schedule->afternoon_start }}</td>
                                <td class="h-10 px-2 text-left font-medium">{{ $schedule->afternoon_end }}</td>
                                <td class="h-10 px-2 text-left font-medium">{{ $schedule->monday ? 'Mon' : '' }}
                                    {{ $schedule->tuesday ? 'Tue' : '' }}
                                    {{ $schedule->wednesday ? 'Wen' : '' }}
                                    {{ $schedule->thursday ? 'Thu' : '' }}
                                    {{ $schedule->friday ? 'Fri' : '' }}
                                    {{ $schedule->saturday ? 'Sat' : '' }}
                                    {{ $schedule->sunday ? 'Sun' : '' }}</td>
                                <td class="h-10 px-2 text-left relative w-10">
                                    <button class="w-full h-full" id="options_menu_btn">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                            viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                            stroke-linecap="round" stroke-linejoin="round"
                                            class="lucide lucide-ellipsis pointer-events-none">
                                            <circle cx="12" cy="12" r="1"></circle>
                                            <circle cx="19" cy="12" r="1"></circle>
                                            <circle cx="5" cy="12" r="1"></circle>
                                        </svg>
                                    </button>
                                    <div class="options_menu z-50 absolute right-0 top-[30px] rounded-sm w-[125px] bg-white border"
                                        id="options_menu">
                                        <a href="{{ route('schedule.update', $schedule->id) }}"
                                            class="flex justify-start gap-2 items-center pl-4 py-3 border-b border-[#eff0f6] hover:bg-[#eff0f6]">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                                viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                                stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                                                class="lucide lucide-file-pen-line">
                                                <path
                                                    d="m18 5-2.414-2.414A2 2 0 0 0 14.172 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2" />
                                                <path
                                                    d="M21.378 12.626a1 1 0 0 0-3.004-3.004l-4.01 4.012a2 2 0 0 0-.506.854l-.837 2.87a.5.5 0 0 0 .62.62l2.87-.837a2 2 0 0 0 .854-.506z" />
                                                <path d="M8 18h1" />
                                            </svg>
                                            <span>Edit</span>
                                        </a>
                                        <form action="{{ route('schedule.destroy', $schedule->id) }}" method="POST"
                                            class="flex justify-start gap-2 items-center pl-4 py-3 hover:bg-[#eff0f6]">
                                            @method('delete')
                                            @csrf
                                            <button class="flex items-center gap-2">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                                    viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                                    stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                                                    class="lucide lucide-trash">
                                                    <path d="M3 6h18" />
                                                    <path d="M19 6v14c0 1-1 2-2 2H7c-1 0-2-1-2-2V6" />
                                                    <path d="M8 6V4c0-1 1-2 2-2h4c1 0 2 1 2 2v2" />
                                                </svg>
                                                <span class="text-[#DC2626]">Delete</span>
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <script>
        let last_menu = null
        document.addEventListener('click', e => {
            if (last_menu != null && last_menu != e.target.nextElementSibling) {
                last_menu.classList.remove('show')
            }
            if (e.target.id == 'options_menu_btn') {
                last_menu = e.target.nextElementSibling
                e.target.nextElementSibling.classList.toggle("show")
            }

        })
    </script>
@endsection

@endsection
