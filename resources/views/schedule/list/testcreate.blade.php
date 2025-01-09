@extends('layouts.testlayout')

@section('content')
    <div class="p-6">
        <div class="flex items-center gap-1">
            <a href="{{ route('schedules') }}" class="text-[#a1a1aa] hover:text-[#454e60]">Schedules</a>
            <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 21 21" fill="none"
                stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                class="lucide lucide-chevron-right text-[#a1a1aa]">
                <path d="m9 18 6-6-6-6"></path>
            </svg>
            <a href="{{ route('schedule.create') }}">Create schedule</a>
        </div>
        <form action="{{ route('schedule.store') }}" method="POST" class="grid grid-cols-2 gap-2 ">
            @csrf
            <div class=" border rounded-md bg-white mt-6">
                <div class="border-b flex justify-between p-5 items-center">
                    <p class="font-semibold text-lg">Schedule Information</p>
                </div>
                <div class="py-2 flex flex-col gap-5">
                    <div class="px-5 mt-2 flex items-center">
                        <label for="name" class="font-semibold mr-2 py-[6px] min-w-[150px] self-start">Name</label>
                        <div class="flex flex-col grow">
                            <input
                                class="bg-transparent text-[#6b6f80] border border-[#e2e4ef] rounded-md h-[42px] px-3 py-1 focus:outline-none focus:border-[#9aa0ac] w-full"
                                type="text" name="name" value="{{ old('name') }}">
                            @error('name')
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
                    <div class="px-5 flex items-center">
                        <label for="morning_start" class="font-semibold mr-2 py-[6px] min-w-[150px] self-start">Morning
                            start</label>
                        <div class="flex flex-col grow">
                            <input
                                class="bg-transparent text-[#6b6f80] border border-[#e2e4ef] rounded-md h-[42px] px-3 py-1 focus:outline-none focus:border-[#9aa0ac] w-full"
                                type="time" name="morning_start" value="{{ old('morning_start') }}">
                            @error('morning_start')
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
                    <div class="px-5 flex items-center">
                        <label for="morning_end" class="font-semibold mr-2 py-[6px] min-w-[150px] self-start">Morning
                            end</label>
                        <div class="flex flex-col grow">
                            <input
                                class="bg-transparent text-[#6b6f80] border border-[#e2e4ef] rounded-md h-[42px] px-3 py-1 focus:outline-none focus:border-[#9aa0ac] w-full"
                                type="time" name="morning_end" value="{{ old('morning_end') }}">
                            @error('morning_end')
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
                    <div class="px-5 flex items-center">
                        <label for="afternoon_start" class="font-semibold mr-2 py-[6px] min-w-[150px] self-start">Afternoon
                            start</label>
                        <div class="flex flex-col grow">
                            <input
                                class="bg-transparent text-[#6b6f80] border border-[#e2e4ef] rounded-md h-[42px] px-3 py-1 focus:outline-none focus:border-[#9aa0ac] w-full"
                                type="time" name="afternoon_start" value="{{ old('afternoon_start') }}">
                            @error('afternoon_start')
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
                    <div class="px-5 mb-2 flex items-center">
                        <label for="afternoon_end" class="font-semibold mr-2 py-[6px] min-w-[150px] self-start">Afternoon
                            end</label>
                        <div class="flex flex-col grow">
                            <input
                                class="bg-transparent text-[#6b6f80] border border-[#e2e4ef] rounded-md h-[42px] px-3 py-1 focus:outline-none focus:border-[#9aa0ac] w-full"
                                type="time" name="afternoon_end" value="{{ old('afternoon_end') }}">
                            @error('afternoon_end')
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
                </div>
            </div>
            <div class=" border rounded-md bg-white mt-6">
                <div class="border-b flex justify-between p-5 items-center">
                    <p class="font-semibold text-lg">Working days</p>
                </div>
                <div class="px-5 py-2 flex items-center flex-col">
                    <div class="flex mb-3 mt-2 py-2 px-6 border rounded-md justify-between w-full items-center">
                        <label class="cursor-pointer select-none font-semibold" for="monday">Monday</label>
                        <button id="monday" onclick=toggleCheckboxButton(this) type="button"
                            class="h-5 w-9 bg-[#CBCFD2] rounded-full border-2 border-transparent duration-[0.15s]">
                            <span id="span_monday"
                                class="bg-white rounded-full h-4 w-4 block duration-[0.15s] checkbox"></span>
                        </button>
                        <input type="checkbox" name="monday" id="checkbox_monday" class="hidden">
                    </div>
                    <div class="flex mb-3 mt-2 py-2 px-6 border rounded-md justify-between w-full items-center">
                        <label class="cursor-pointer select-none font-semibold" for="tuesday">Tuesday</label>
                        <button id="tuesday" onclick=toggleCheckboxButton(this) type="button"
                            class="h-5 w-9 bg-[#CBCFD2] rounded-full border-2 border-transparent duration-[0.15s]">
                            <span id="span_tuesday"
                                class="bg-white rounded-full h-4 w-4 block duration-[0.15s] checkbox"></span>
                        </button>
                        <input type="checkbox" name="tuesday" id="checkbox_tuesday" class="hidden">
                    </div>
                    <div class="flex mb-3 mt-2 py-2 px-6 border rounded-md justify-between w-full items-center">
                        <label class="cursor-pointer select-none font-semibold" for="wednesday">Wednesday</label>
                        <button id="wednesday" onclick=toggleCheckboxButton(this) type="button"
                            class="h-5 w-9 bg-[#CBCFD2] rounded-full border-2 border-transparent duration-[0.15s]">
                            <span id="span_wednesday"
                                class="bg-white rounded-full h-4 w-4 block duration-[0.15s] checkbox"></span>
                        </button>
                        <input type="checkbox" name="wednesday" id="checkbox_wednesday" class="hidden">
                    </div>
                    <div class="flex mb-3 mt-2 py-2 px-6 border rounded-md justify-between w-full items-center">
                        <label class="cursor-pointer select-none font-semibold" for="thursday">Thursday</label>
                        <button id="thursday" onclick=toggleCheckboxButton(this) type="button"
                            class="h-5 w-9 bg-[#CBCFD2] rounded-full border-2 border-transparent duration-[0.15s]">
                            <span id="span_thursday"
                                class="bg-white rounded-full h-4 w-4 block duration-[0.15s] checkbox"></span>
                        </button>
                        <input type="checkbox" name="thursday" id="checkbox_thursday" class="hidden">
                    </div>
                    <div class="flex mb-3 mt-2 py-2 px-6 border rounded-md justify-between w-full items-center">
                        <label class="cursor-pointer select-none font-semibold" for="friday">Friday</label>
                        <button id="friday" onclick=toggleCheckboxButton(this) type="button"
                            class="h-5 w-9 bg-[#CBCFD2] rounded-full border-2 border-transparent duration-[0.15s]">
                            <span id="span_friday"
                                class="bg-white rounded-full h-4 w-4 block duration-[0.15s] checkbox"></span>
                        </button>
                        <input type="checkbox" name="friday" id="checkbox_friday" class="hidden">
                    </div>
                    <div class="flex mb-3 mt-2 py-2 px-6 border rounded-md justify-between w-full items-center">
                        <label class="cursor-pointer select-none font-semibold" for="saturday">Saturday</label>
                        <button id="saturday" onclick=toggleCheckboxButton(this) type="button"
                            class="h-5 w-9 bg-[#CBCFD2] rounded-full border-2 border-transparent duration-[0.15s]">
                            <span id="span_saturday"
                                class="bg-white rounded-full h-4 w-4 block duration-[0.15s] checkbox"></span>
                        </button>
                        <input type="checkbox" name="saturday" id="checkbox_saturday" class="hidden">
                    </div>
                    <div class="flex mb-3 mt-2 py-2 px-6 border rounded-md justify-between w-full items-center">
                        <label class="cursor-pointer select-none font-semibold" for="sunday">Sunday</label>
                        <button id="sunday" onclick=toggleCheckboxButton(this) type="button"
                            class="h-5 w-9 bg-[#CBCFD2] rounded-full border-2 border-transparent duration-[0.15s]">
                            <span id="span_sunday"
                                class="bg-white rounded-full h-4 w-4 block duration-[0.15s] checkbox"></span>
                        </button>
                        <input type="checkbox" name="sunday" id="checkbox_sunday" class="hidden">
                    </div>
                </div>
            </div>
            <div class="flex items-center mt-6">
                <button
                    class="hover:bg-[#ff7f31] bg-[#FF8B45] font-semibold rounded-md h-9 mx-5 mb-5 px-6 text-white tracking-wider">Create
                    schedule
                </button>
                <a href="{{ route('schedules') }}"
                    class="font-semibold border rounded-md h-9 mb-5 px-6 tracking-wider flex items-center bg-[#f4f5f7] border-[#CBCFD2] hover:bg-[#CBCFD2] hover:border-[#dae0e5]"><span>Cancel</span>
                </a>
            </div>
        </form>
    </div>
    </div>
    </div>
    <script>
        function toggle_role_menu(button) {
            button.nextElementSibling.classList.toggle("show");
        }

        function get_role(role) {
            role_label = document.getElementById("role_label")
            role_label.textContent = role.textContent
            role_label.click()
        }

        function toggleCheckboxButton(value) {
            button = value
            button_span = document.getElementById("span_" + value.id)
            checkbox = document.getElementById("checkbox_" + value.id)
            checkbox.checked = !checkbox.checked ? true : false
            button_span.classList.toggle("checkboxActive")
            button.classList.toggle("buttonActive")
        }
    </script>
@endsection
