@extends('layouts.testlayout')

@section('content')
    <div class="px-6">
        <div class=" border rounded-md bg-white mb-6 mt-6">
            <div class="border-b flex justify-between p-5 items-center">
                <p class="font-semibold text-lg">Add holiday</p>
            </div>
            <div class="px-5 flex flex-col mb-6 mt-6">
                <form action="{{ route('store.holidays') }}" method="POST" class="flex gap-3">
                    @csrf
                    <div class="flex">
                        <button type="button"
                            class="select_year_button flex items-center justify-between bg-transparent text-[#6b6f80] border border-[#e2e4ef] rounded-md h-[42px] px-3 py-1 focus:outline-none focus:border-[#9aa0ac] w-[100px]"
                            onclick="toggle_menu(this)">
                            <span id="button_year_label" class="pointer-events-none text-[#9ca3af]">
                                year </span>
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24"
                                fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                stroke-linejoin="round"
                                class="lucide lucide-chevron-down text-muted-foreground pointer-events-none">
                                <path d="m6 9 6 6 6-6"></path>
                            </svg>
                        </button>
                        <div class="select_year_menu grid absolute bg-white">
                            <div class="overflow-hidden">
                                @for ($i = date('Y'); $i < date('Y') + 5; $i++)
                                    <div
                                        class="flex items-center px-3 rounded-md hover:bg-[#eff0f6] text-[#6b6f80] w-[100px]">
                                        <input type="radio" name="year" id="year_{{ $i }}"
                                            value="{{ $i }}" class="peer hidden">
                                        <label for="year_{{ $i }}" class="grow cursor-pointer py-1"
                                            onclick=get_year(this)>{{ $i }}</label>
                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                            viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                            stroke-linecap="round" stroke-linejoin="round"
                                            class="lucide lucide-check mr-2 opacity-100 m-auto  hidden peer-checked:block">
                                            <path d="M20 6 9 17l-5-5"></path>
                                        </svg>
                                    </div>
                                @endfor
                            </div>
                        </div>
                    </div>
                    <div class="flex">
                        <button type="button"
                            class="select_month_button flex items-center justify-between bg-transparent text-[#6b6f80] border border-[#e2e4ef] rounded-md h-[42px] px-3 py-1 focus:outline-none focus:border-[#9aa0ac] w-[130px]"
                            onclick="toggle_menu(this)">
                            <span id="button_month_label" class="pointer-events-none text-[#9ca3af]">month</span>
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24"
                                fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                stroke-linejoin="round"
                                class="lucide lucide-chevron-down text-muted-foreground pointer-events-none">
                                <path d="m6 9 6 6 6-6"></path>
                            </svg>
                        </button>
                        <div class="select_month_menu grid absolute bg-white">
                            <div class="overflow-hidden">
                                @foreach ($months as $month)
                                    <div
                                        class="flex items-center px-3 rounded-md hover:bg-[#eff0f6] text-[#6b6f80] w-[130px]">
                                        <input type="radio" name="month" id="{{ $month['name'] }}"
                                            value="{{ $month['number'] }}" class="peer hidden">
                                        <label for="{{ $month['name'] }}" class="grow cursor-pointer py-1"
                                            onclick=get_month(this)
                                            value="{{ $month['days'] }}">{{ $month['name'] }}</label>
                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                            viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                            stroke-linecap="round" stroke-linejoin="round"
                                            class="lucide lucide-check mr-2 opacity-100 m-auto  hidden peer-checked:block">
                                            <path d="M20 6 9 17l-5-5"></path>
                                        </svg>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                    <div class="flex">
                        <button type="button"
                            class="select_day_button flex items-center justify-between bg-transparent text-[#6b6f80] border border-[#e2e4ef] rounded-md h-[42px] px-3 py-1 focus:outline-none focus:border-[#9aa0ac] w-[80px]"
                            onclick="toggle_menu_day(this)">
                            <span id="button_day_label" class="pointer-events-none text-[#9ca3af]">
                                day </span>
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24"
                                fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                stroke-linejoin="round"
                                class="lucide lucide-chevron-down text-muted-foreground pointer-events-none">
                                <path d="m6 9 6 6 6-6"></path>
                            </svg>
                        </button>
                        <div class="select_day_menu grid absolute bg-white">
                            <div class="overflow-hidden">
                                <div class="grid grid-cols-5 p-1" id="day_wrapper"></div>
                            </div>
                        </div>
                    </div>
                    <input
                        class="bg-transparent text-[#6b6f80] border border-[#e2e4ef] rounded-md h-[42px] px-3 py-1 focus:outline-none focus:border-[#9aa0ac] w-[300px]"
                        type="text" name="name" placeholder="name">
                    <button
                        class="hover:bg-[#ff7f31] bg-[#FF8B45] font-semibold rounded-md h-[42px] px-6 text-white tracking-wider w-[150px]">Add
                        holiday</button>
                </form>
                @error('error')
                    <div class="flex h-[24px] text-[#dc3838] items-center justify-start text-sm gap-1 pl-2">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14"
                            class=" flex-shrink-0 w-[16px] h-[16px]">
                            <path fill="#dc3838" fill-rule="evenodd"
                                d="M13.4 7A6.4 6.4 0 1 1 .6 7a6.4 6.4 0 0 1 12.8 0Zm-5.6 3.2a.8.8 0 1 1-1.6 0 .8.8 0 0 1 1.6 0ZM7 3a.8.8 0 0 0-.8.8V7a.8.8 0 0 0 1.6 0V3.8A.8.8 0 0 0 7 3Z"
                                clip-rule="evenodd"></path>
                        </svg>
                        <span>{{ $message }}</span>
                    </div>
                @enderror
            </div>
        </div>
        <div class=" border rounded-md bg-white mb-6 mt-6">
            <div class="border-b flex justify-between p-5 items-center">
                <p class="font-semibold text-lg">Holidays {{ $year }}</p>
                <div class="flex gap-3">
                    <a href="{{ route('calendar.holidays', $year - 1) }}"
                        class="flex items-center justify-center border p-2 rounded-md gap-2 hover:bg-[#eff0f6] w-[75px]">
                        <span>previous</span></a>
                    <a href="{{ route('calendar.holidays', $year + 1) }}"
                        class="flex items-center justify-center border p-2 rounded-md gap-2 hover:bg-[#eff0f6] w-[75px]">
                        <span>next</span></a>
                </div>
            </div>
            <div class="p-5">
                <table class="w-full text-left">
                    <thead>
                        <tr class="h-10 border rounded-sm">
                            <th>
                                <button class="flex items-center justify-between w-full px-2 ">
                                    <span class="text-sm font-semibold h-6 text-[#454e60]">
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
                            </th>
                            <th>
                                <button class="flex items-center justify-between w-full px-2 ">
                                    <span class="text-sm font-semibold h-6 text-[#454e60]">
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
                            </th>
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
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($holidays as $holiday)
                            <tr class="border  hover:bg-[#f4f5f7]/80">
                                <td class="h-10 px-2 text-left font-medium">{{ $holiday->month }}</td>
                                <td class="h-10 px-2 text-left font-medium">{{ $holiday->day }}</td>
                                <td class="h-10 px-2 text-left font-medium">{{ $holiday->name }}</td>
                                <td class="h-10 px-2 text-left w-10">
                                    <form action="{{ route('delete.holidays', $holiday->id) }}" method="POST"
                                        class="flex items-center">
                                        @method('delete')
                                        @csrf
                                        <button>
                                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                                viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                                stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                                                class="lucide lucide-x">
                                                <path d="M18 6 6 18" />
                                                <path d="m6 6 12 12" />
                                            </svg>
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <script>
        document.addEventListener('click', e => {
            const list = document.getElementsByClassName('show');
            const year_button = document.getElementsByClassName('select_year_button')[0]
            const month_button = document.getElementsByClassName('select_month_button')[0]
            const day_button = document.getElementsByClassName('select_day_button')[0]

            if (e.target !== year_button && e.target !== month_button && e.target !== day_button) {
                if (year_button.nextElementSibling.classList.contains('show')) {
                    year_button.nextElementSibling.classList.toggle('show')
                }
                if (month_button.nextElementSibling.classList.contains('show')) {
                    month_button.nextElementSibling.classList.toggle('show')
                }
                if (day_button.nextElementSibling.classList.contains('show')) {
                    day_button.nextElementSibling.classList.toggle('show')
                }
            } else {
                if (e.target == year_button) {
                    if (month_button.nextElementSibling.classList.contains('show')) {
                        month_button.nextElementSibling.classList.toggle('show')
                    }
                    if (day_button.nextElementSibling.classList.contains('show')) {
                        day_button.nextElementSibling.classList.toggle('show')
                    }
                }
                if (e.target == month_button) {
                    if (year_button.nextElementSibling.classList.contains('show')) {
                        year_button.nextElementSibling.classList.toggle('show')
                    }
                    if (day_button.nextElementSibling.classList.contains('show')) {
                        day_button.nextElementSibling.classList.toggle('show')
                    }
                }
                if (e.target == day_button) {
                    if (year_button.nextElementSibling.classList.contains('show')) {
                        year_button.nextElementSibling.classList.toggle('show')
                    }
                    if (month_button.nextElementSibling.classList.contains('show')) {
                        month_button.nextElementSibling.classList.toggle('show')
                    }
                }
            }
        })

        function toggle_menu(button) {
            button.nextElementSibling.classList.toggle("show");
        }

        function toggle_menu_day(button) {
            button_month_label = document.getElementById('button_month_label')
            if (button_month_label.textContent !== 'month') {
                button.nextElementSibling.classList.toggle("show");
            }
        }

        function get_year(value) {
            button_year_label = document.getElementById("button_year_label")
            button_year_label.textContent = value.textContent
            button_year_label.classList.remove("text-[#9ca3af]")
            button_year_label.click()
        }

        function get_month(value) {
            button_month_label = document.getElementById("button_month_label")
            button_month_label.textContent = value.textContent
            button_month_label.classList.remove("text-[#9ca3af]")
            button_month_label.click()

            wrapper_content = "";
            days = value.getAttribute('value')
            console.log(days)
            day_wrapper = document.getElementById("day_wrapper")
            for (i = 1; i <= days; i++) {
                wrapper_content +=
                    "<div class='flex items-center text-center text-[#6b6f80] hover:bg-[#eff0f6] px-1 rounded-md'><input type='radio' name='day' id=" +
                    i + " value=" + i + " class='peer hidden'><label for=" + i +
                    " class='w-[28px] cursor-pointer py-1 select-none' value=" + i +
                    " onclick=get_day(this)>" + i + "</label></div>"
            }
            day_wrapper.innerHTML = wrapper_content
        }

        function get_day(value) {
            button_day_label = document.getElementById("button_day_label")
            button_day_label.textContent = value.textContent
            button_day_label.classList.remove("text-[#9ca3af]")
            button_day_label.click()
        }
    </script>
@endsection
