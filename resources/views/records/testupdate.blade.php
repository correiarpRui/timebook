@extends('layouts.testlayout')

@section('content')
    <div class="p-6">
        <div class="flex items-center gap-1">
            <a href="{{ route('records') }}" class="text-[#a1a1aa] hover:text-[#454e60]">Records</a>
            <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 21 21" fill="none"
                stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                class="lucide lucide-chevron-right text-[#a1a1aa]">
                <path d="m9 18 6-6-6-6"></path>
            </svg>
            <a href="{{ route('record.show', $record->id) }}" class="text-[#a1a1aa] hover:text-[#454e60]">Record
                {{ $record->id }}</a>
            <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 21 21" fill="none"
                stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                class="lucide lucide-chevron-right text-[#a1a1aa]">
                <path d="m9 18 6-6-6-6"></path>
            </svg>
            <a href="{{ route('record.update', $record->id) }}">Update record</a>
        </div>
        <form action="{{ route('record.patch', $record->id) }}" method="POST">
            @csrf
            @method('PATCH')
            <div class=" border rounded-md bg-white mt-6">
                <div class="border-b flex justify-between p-5 items-center">
                    <p class="font-semibold text-lg">Record information</p>
                </div>
                <div class="py-2 flex flex-col gap-5">
                    <div class="px-5 mt-2 flex items-center">
                        <label for="morning_start" class="font-semibold mr-2 min-w-[150px] py-[6px] self-start">Morning
                            Start</label>
                        <div class="flex flex-col grow">
                            <input
                                class="bg-transparent text-[#6b6f80] border border-[#e2e4ef] rounded-md h-[42px] px-3 py-1 focus:outline-none focus:border-[#9aa0ac] w-full"
                                type="text" name="morning_start" value="{{ $record->morning_start }}">
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
                </div>
                <div class="py-2 flex flex-col gap-5">
                    <div class="px-5 mt-2 flex items-center">
                        <label for="morning_end" class="font-semibold mr-2 min-w-[150px] py-[6px] self-start">Morning
                            End</label>
                        <div class="flex flex-col grow">
                            <input
                                class="bg-transparent text-[#6b6f80] border border-[#e2e4ef] rounded-md h-[42px] px-3 py-1 focus:outline-none focus:border-[#9aa0ac] w-full"
                                type="text" name="morning_end" value="{{ $record->morning_end }}">
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
                </div>
                <div class="py-2 flex flex-col gap-5">
                    <div class="px-5 mt-2 flex items-center">
                        <label for="afternoon_start" class="font-semibold mr-2 min-w-[150px] py-[6px] self-start">Afternoon
                            Start</label>
                        <div class="flex flex-col grow">
                            <input
                                class="bg-transparent text-[#6b6f80] border border-[#e2e4ef] rounded-md h-[42px] px-3 py-1 focus:outline-none focus:border-[#9aa0ac] w-full"
                                type="text" name="afternoon_start" value="{{ $record->afternoon_start }}">
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
                </div>
                <div class="py-2 flex flex-col gap-5">
                    <div class="px-5 mt-2 flex items-center">
                        <label for="afternoon_end" class="font-semibold mr-2 min-w-[150px] py-[6px] self-start">Afternoon
                            End</label>
                        <div class="flex flex-col grow">
                            <input
                                class="bg-transparent text-[#6b6f80] border border-[#e2e4ef] rounded-md h-[42px] px-3 py-1 focus:outline-none focus:border-[#9aa0ac] w-full"
                                type="text" name="afternoon_end" value="{{ $record->afternoon_end }}">
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
                <div class="py-2 flex flex-col gap-5">
                    <div class="px-5 mt-2 flex items-center">
                        <label for="is_present"
                            class="font-semibold mr-2 min-w-[150px] py-[6px] self-start cursor-pointer">Presence</label>
                        <div class="flex flex-col grow">

                            <button id="is_present" onclick=toggleCheckboxButton(this) type="button"
                                class="h-5 w-9 bg-[#CBCFD2] rounded-full border-2 border-transparent duration-[0.15s] {{ $record->is_present ? 'buttonActive' : '' }}">
                                <span id="span_is_present"
                                    class="bg-white rounded-full h-4 w-4 block duration-[0.15s] checkbox {{ $record->is_present ? 'checkboxActive' : '' }}"></span>
                            </button>
                            <input type="checkbox" name="is_present" id="checkbox_is_present" class="hidden"
                                {{ $record->is_present ? 'checked' : '' }}>
                        </div>
                    </div>
                </div>
            </div>
            <div class="flex items-center mt-6">
                <button
                    class="hover:bg-[#ff7f31] bg-[#FF8B45] font-semibold rounded-md h-9 mx-5 mb-5 px-6 text-white tracking-wider">Update
                    record
                </button>
                <a href="{{ route('record.show', $record->id) }}"
                    class="font-semibold border rounded-md h-9 mb-5 px-6 tracking-wider flex items-center bg-[#f4f5f7] border-[#CBCFD2] hover:bg-[#CBCFD2] hover:border-[#dae0e5]"><span>Cancel</span>
                </a>
            </div>
        </form>
    </div>
    <script>
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
