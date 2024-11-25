@extends('layouts.layout')

@section('content')
    <div class="text-[#fafafa] flex flex-col">
        <ol class="flex items-center p-2 gap-1">
            <li>
                <a href="{{ route('schedule') }}" class="text-[#a1a1aa] hover:text-[#fafafa]">Schedules</a>
            </li>
            <li>
                <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 21 21" fill="none"
                    stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                    class="lucide lucide-chevron-right text-[#a1a1aa]">
                    <path d="m9 18 6-6-6-6"></path>
                </svg>
            </li>
            <li>
                <a href="{{ route('schedule.create') }}">Add schedule</a>
            </li>
        </ol>
        <div class="p-6 max-w-[42rem]">
            <div class="text-2xl font-bold tracking-tight text-[#fafafa]">
                Create Schedule
            </div>
            <hr class="my-[12px] border-[#27272a]">
            <form action="{{ route('schedule.store') }}" method="POST" class="flex flex-col gap-4">
                @csrf
                <div class="flex flex-col gap-1">
                    <label for="name" class="text-sm font-medium">Name</label>
                    <input
                        class="bg-transparent border border-[#27272a] rounded-md h-9 px-3 py-1 focus:outline-none focus:border-[#e5e7eb]"
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
                <div class="flex flex-col gap-1">
                    <label for="morning_start" class="text-sm font-medium">Morning start</label>
                    <input
                        class="bg-transparent border border-[#27272a] rounded-md h-9 px-3 py-1 focus:outline-none focus:border-[#e5e7eb]"
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
                <div class="flex flex-col gap-1">
                    <label for="morning_end" class="text-sm font-medium">Morning end</label>
                    <input
                        class="bg-transparent border border-[#27272a] rounded-md h-9 px-3 py-1 focus:outline-none focus:border-[#e5e7eb]"
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
                <div class="flex flex-col gap-1">
                    <label for="afternoon_start" class="text-sm font-medium">Afternoon start</label>
                    <input
                        class="bg-transparent border border-[#27272a] rounded-md h-9 px-3 py-1 focus:outline-none focus:border-[#e5e7eb]"
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
                <div class="flex flex-col gap-1">
                    <label for="afternoon_end" class="text-sm font-medium">Afternoon end</label>
                    <input
                        class="bg-transparent border border-[#27272a] rounded-md h-9 px-3 py-1 focus:outline-none focus:border-[#e5e7eb]"
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

                <div class="text-lg font-medium pr-2">Working days</div>
                <div>
                    <div class="flex mb-3 py-4 px-6 border border-[#27272a] rounded-md justify-between sele">
                        <label class="cursor-pointer select-none" for="monday">Monday</label>
                        <button id="monday" onclick=toggleCheckboxButton(this) type="button"
                            class="h-5 w-9 bg-[#27272a] rounded-full border-2 border-transparent duration-[0.15s]">
                            <span id="span_monday"
                                class="bg-[#09090b] rounded-full h-4 w-4 block duration-[0.15s]"></span>
                        </button>
                        <input type="checkbox" name="monday" id="checkbox_monday" class="hidden">
                    </div>
                    <div class="flex mb-3 py-4 px-6 border border-[#27272a] rounded-md justify-between sele">
                        <label class="cursor-pointer select-none" for="tuesday">Tuesday</label>
                        <button id="tuesday" onclick=toggleCheckboxButton(this) type="button"
                            class="h-5 w-9 bg-[#27272a] rounded-full border-2 border-transparent duration-[0.15s]">
                            <span id="span_tuesday"
                                class="bg-[#09090b] rounded-full h-4 w-4 block duration-[0.15s]"></span>
                        </button>
                        <input type="checkbox" name="tuesday" id="checkbox_tuesday" class="hidden">
                    </div>
                    <div class="flex mb-3 py-4 px-6 border border-[#27272a] rounded-md justify-between sele">
                        <label class="cursor-pointer select-none" for="wednesday">Wednesday</label>
                        <button id="wednesday" onclick=toggleCheckboxButton(this) type="button"
                            class="h-5 w-9 bg-[#27272a] rounded-full border-2 border-transparent duration-[0.15s]">
                            <span id="span_wednesday"
                                class="bg-[#09090b] rounded-full h-4 w-4 block duration-[0.15s]"></span>
                        </button>
                        <input type="checkbox" name="wednesday" id="checkbox_wednesday" class="hidden">
                    </div>
                    <div class="flex mb-3 py-4 px-6 border border-[#27272a] rounded-md justify-between sele">
                        <label class="cursor-pointer select-none" for="thursday">Thursday</label>
                        <button id="thursday" onclick=toggleCheckboxButton(this) type="button"
                            class="h-5 w-9 bg-[#27272a] rounded-full border-2 border-transparent duration-[0.15s]">
                            <span id="span_thursday"
                                class="bg-[#09090b] rounded-full h-4 w-4 block duration-[0.15s]"></span>
                        </button>
                        <input type="checkbox" name="thursday" id="checkbox_thursday" class="hidden">
                    </div>
                    <div class="flex mb-3 py-4 px-6 border border-[#27272a] rounded-md justify-between sele">
                        <label class="cursor-pointer select-none" for="friday">Friday</label>
                        <button id="friday" onclick=toggleCheckboxButton(this) type="button"
                            class="h-5 w-9 bg-[#27272a] rounded-full border-2 border-transparent duration-[0.15s]">
                            <span id="span_friday"
                                class="bg-[#09090b] rounded-full h-4 w-4 block duration-[0.15s]"></span>
                        </button>
                        <input type="checkbox" name="friday" id="checkbox_friday" class="hidden">
                    </div>
                    <div class="flex mb-3 py-4 px-6 border border-[#27272a] rounded-md justify-between sele">
                        <label class="cursor-pointer select-none" for="saturday">Saturday</label>
                        <button id="saturday" onclick=toggleCheckboxButton(this) type="button"
                            class="h-5 w-9 bg-[#27272a] rounded-full border-2 border-transparent duration-[0.15s]">
                            <span id="span_saturday"
                                class="bg-[#09090b] rounded-full h-4 w-4 block duration-[0.15s]"></span>
                        </button>
                        <input type="checkbox" name="saturday" id="checkbox_saturday" class="hidden">
                    </div>
                    <div class="flex mb-3 py-4 px-6 border border-[#27272a] rounded-md justify-between sele">
                        <label class="cursor-pointer select-none" for="sunday">Sunday</label>
                        <button id="sunday" onclick=toggleCheckboxButton(this) type="button"
                            class="h-5 w-9 bg-[#27272a] rounded-full border-2 border-transparent duration-[0.15s]">
                            <span id="span_sunday"
                                class="bg-[#09090b] rounded-full h-4 w-4 block duration-[0.15s]"></span>
                        </button>
                        <input type="checkbox" name="sunday" id="checkbox_sunday" class="hidden">
                    </div>
                </div>
                <button class="bg-[#fafafa] text-[#09090b] font-medium rounded-md h-9 mr-auto mt-2 px-6 text-sm">Create
                    schedule</button>
            </form>
        </div>
    </div>
@endsection
