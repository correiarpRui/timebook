@extends('layouts.layout')

@section('content')
    <div class="text-[#fafafa] p-6">

        <div class="flex justify-between">
            <div class="text-2xl font-bold tracking-tight text-[#fafafa]">Calendar settings</div>
        </div>
        <hr class="my-[24px] border-[#27272a]">

        <form action="" class="flex gap-4">
            @csrf

            <div>
                <button class="bg-transparent border border-[#27272a] rounded-md h-9 px-3 flex justify-between items-center"
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
                            <div class="flex items-center hover:bg-[#27272a] px-3 rounded-md">
                                <input type="radio" name="month" id="{{ $month['name'] }}"
                                    value="{{ $month['number'] }}" class="peer hidden">
                                <label for="{{ $month['name'] }}" class="grow cursor-pointer py-1 select-none"
                                    value="{{ $month['days'] }}" onclick=get_month_name(this)>{{ $month['name'] }}</label>
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24"
                                    fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                    stroke-linejoin="round"
                                    class="lucide lucide-check mr-2 opacity-100 m-auto  hidden peer-checked:block">
                                    <path d="M20 6 9 17l-5-5"></path>
                                </svg>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
            <div>
                <button class="bg-transparent border border-[#27272a] rounded-md h-9 px-3 flex justify-between items-center"
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
                type="text" name="holiday_name" placeholder="name">
            <button class="bg-[#fafafa] text-[#09090b] font-medium rounded-md h-9 px-4 text-sm">Add
                holiday</button>
        </form>
        <div class="flex flex-col gap-2">
            @foreach ($months as $month)
                <div>
                    <div class="font-medium pt-4 pb-2 px-2">{{ $month['name'] }}</div>
                    @foreach ($holidays[$month['number']] as $day => $name)
                        <div class="flex gap-2 border border-[#27272a] rounded-lg py-2 px-4 mb-2">
                            <div>{{ $day }}</div>
                            <div>{{ $name }}</div>
                        </div>
                    @endforeach

                </div>
            @endforeach
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
                    "<div class='flex items-center hover:bg-[#27272a] px-3 rounded-md'><input type='radio' name='day' id=" +
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
    </script>
@endsection
