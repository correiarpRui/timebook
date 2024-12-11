@extends('layouts.layout')

@section('content')
    <div class="text-[#fafafa] p-6">
        <div class="flex justify-between">
            <div class="text-2xl font-bold tracking-tight text-[#fafafa]">Calendar settings {{ $year }}</div>
            <div class="flex gap-3">
                <a class="bg-[#fafafa] text-[#09090b] flex items-center gap-2 rounded-md px-4 py-2 cursor-pointer text-sm font-medium"
                    href="{{ route('calendar.settings', $year - 1) }}">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none"
                        stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                        class="lucide lucide-chevron-left">
                        <path d="m15 18-6-6 6-6" />
                    </svg>
                </a>
                <a class="bg-[#fafafa] text-[#09090b] flex items-center gap-2 rounded-md px-4 py-2 cursor-pointer text-sm font-medium"
                    href="{{ route('calendar.settings', $year + 1) }}">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none"
                        stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                        class="lucide lucide-chevron-right">
                        <path d="m9 18 6-6-6-6" />
                    </svg>
                </a>
            </div>
        </div>
        <hr class="my-[24px] border-[#27272a]">
        <form action="{{ route('store_settings') }}" method="POST" class="flex gap-4 mb-4">
            @csrf
            <div>
                <button
                    class="bg-transparent border border-[#27272a] rounded-md h-9 px-3 flex justify-between items-center gap-2 w-[100px]"
                    type="button" onclick=toggleSubMenuDropDown(this)>
                    <span id="button_year_label" class="text-[#9ca3af]">year</span>
                    <svg class="flex-shrink-0" xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                        viewBox="0 0 24 24" fill="none" stroke="#9ca3af" stroke-width="2" stroke-linecap="round"
                        stroke-linejoin="round" class="lucide lucide-chevron-down ">
                        <path d="m6 9 6 6 6-6"></path>
                    </svg>
                </button>
                <div class="bg-[#09090b] rounded-md px-1 grid submenu_options absolute">
                    <div class="overflow-hidden">
                        @for ($i = date('Y'); $i < date('Y') + 5; $i++)
                            <div class="flex items-center hover:bg-[#27272a] px-3 rounded-md w-[90px]">
                                <input type="radio" name="year" id="year_{{ $i }}"
                                    value="{{ $i }}" class="peer hidden">
                                <label for="year_{{ $i }}" class="grow cursor-pointer py-1 select-none"
                                    value="{{ $i }}" onclick=get_year(this)>{{ $i }}</label>
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24"
                                    fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                    stroke-linejoin="round"
                                    class="lucide lucide-check opacity-100 m-auto  hidden peer-checked:block">
                                    <path d="M20 6 9 17l-5-5"></path>
                                </svg>
                            </div>
                        @endfor
                    </div>
                </div>
            </div>
            <div>
                <button
                    class="bg-transparent border border-[#27272a] rounded-md h-9 px-3 flex justify-between items-center gap-2 w-[140px]"
                    type="button" onclick=toggleSubMenuDropDown(this)>
                    <span id="button_month_label" class="text-[#9ca3af]">month</span>
                    <svg class="flex-shrink-0" xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                        viewBox="0 0 24 24" fill="none" stroke="#9ca3af" stroke-width="2" stroke-linecap="round"
                        stroke-linejoin="round" class="lucide lucide-chevron-down ">
                        <path d="m6 9 6 6 6-6"></path>
                    </svg>
                </button>
                <div class="bg-[#09090b] rounded-md px-1 grid submenu_options absolute">
                    <div class="overflow-hidden">
                        @foreach ($months as $month)
                            <div class="flex items-center hover:bg-[#27272a] px-3 rounded-md w-[130px]">
                                <input type="radio" name="month" id="{{ $month['name'] }}"
                                    value="{{ $month['number'] }}" class="peer hidden">
                                <label for="{{ $month['name'] }}" class="grow cursor-pointer py-1 select-none"
                                    value="{{ $month['days'] }}" onclick=get_month_name(this)>{{ $month['name'] }}</label>
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24"
                                    fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                    stroke-linejoin="round"
                                    class="lucide lucide-check opacity-100 m-auto  hidden peer-checked:block">
                                    <path d="M20 6 9 17l-5-5"></path>
                                </svg>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
            <div>
                <button
                    class="bg-transparent border border-[#27272a] rounded-md h-9 px-3 flex justify-between items-center gap-2 w-[70px]"
                    type="button" onclick=toggleSubMenuDropDown(this)>
                    <span id="button_day_label" class="text-[#9ca3af]">day</span>
                    <svg class="flex-shrink-0" xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                        viewBox="0 0 24 24" fill="none" stroke="#9ca3af" stroke-width="2" stroke-linecap="round"
                        stroke-linejoin="round" class="lucide lucide-chevron-down ">
                        <path d="m6 9 6 6 6-6"></path>
                    </svg>
                </button>
                <div class="bg-[#09090b] rounded-md px-1 grid submenu_options absolute">
                    <div class="overflow-hidden grid grid-cols-5" id="day_wrapper">



                    </div>
                </div>
            </div>
            <input
                class="bg-transparent border border-[#27272a] rounded-md h-9 px-4 py-1 focus:outline-none focus:border-[#e5e7eb]"
                type="text" name="name" placeholder="name">
            <button class="bg-[#fafafa] text-[#09090b] font-medium rounded-md h-9 px-4 text-sm">Add
                holiday</button>
        </form>

        <div class="border rounded-md border-[#27272a]">
            <table class="text-sm w-full border border-b border-[#27272a] text-[#fafafa]">
                <thead>
                    <tr class="border border-b border-[#27272a] hover:bg-[#27272a]/50">
                        <th class="h-10 px-2 text-left align-middle font-medium">
                            <div class="flex items-center">
                                <button class="flex items-center gap-2 px-3 py-1 rounded-md hover:bg-[#27272a]">
                                    <span>
                                        Month
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
                                        Day
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
                        <th class="h-10 px-2 text-left align-middle font-medium w-16"></th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($holidays as $holiday)
                        <tr class="border border-b border-[#27272a] hover:bg-[#27272a]/50">
                            <td class="h-10 px-5 text-left align-middle font-medium">{{ $holiday->month }}</td>
                            <td class="h-10 px-5 text-left align-middle font-medium">{{ $holiday->day }}</td>
                            <td class="h-10 px-5 text-left align-middle font-medium">{{ $holiday->name }}</td>
                            <td class="h-10 px-5 text-left align-middle font-medium relative">
                                <form action="{{ route('delete_settings', $holiday->id) }}" method="POST"
                                    class="mr-4">
                                    @method('delete')
                                    @csrf
                                    <button class="rounded-md flex items-center gap-1">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                            viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                            stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-x">
                                            <path d="M18 6 6 18" />
                                            <path d="m6 6 12 12" />
                                        </svg>
                                    </button>
                                </form>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

    </div>
    <script>
        function get_month_name(value) {
            button_month_label = document.getElementById("button_month_label")
            button_month_label.textContent = value.textContent
            button_month_label.click()

            wrapper_content = "";
            days = value.getAttribute('value')
            day_wrapper = document.getElementById("day_wrapper")
            for (i = 1; i <= days; i++) {
                wrapper_content +=
                    "<div class='flex items-center text-center hover:bg-[#27272a] px-3 rounded-md'><input type='radio' name='day' id=" +
                    i + " value=" + i + " class='peer hidden'><label for=" + i +
                    " class='grow cursor-pointer py-1 select-none' value=" + i +
                    " onclick=get_day(this)>" + i + "</label></div>"
            }
            day_wrapper.innerHTML = wrapper_content
        }

        function get_day(value) {
            button_day_label = document.getElementById("button_day_label")
            button_day_label.textContent = value.textContent
            button_day_label.click()
        }

        function get_year(value) {
            button_year_label = document.getElementById("button_year_label")
            button_year_label.textContent = value.textContent
            button_year_label.click()
        }
    </script>
@endsection
