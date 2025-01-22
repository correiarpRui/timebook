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
            <a href="{{ route('record.show', $record->id) }}">Record
                {{ $record->id }}</a>
        </div>
        <div class=" border rounded-md bg-white mb-6 mt-6">
            <div class="border-b flex justify-between p-4 items-center">
                <div>
                    <p class="font-semibold text-xl">Record information</p>
                </div>
                {{-- <div>
                    <p class="font-semibold text-xl">Record #{{ $record->id }}</p>
                    <div class="text-sm font-semibold text-[#a1a1aa]">{{ $record->date }},
                        {{ $record->week_day }}</div>
                </div> --}}
                <div class="flex gap-3">
                    <a href="{{ route('record.update', $record->id) }}"
                        class="flex items-center justify-center border p-2 rounded-md gap-2 hover:bg-[#eff0f6] w-[75px]">
                        <span>Edit</span></a>
                    <form action="{{ route('record.destroy', $record->id) }}" method="POST">
                        @method('delete')
                        @csrf
                        <button
                            class="flex items-center justify-center border p-2 rounded-md gap-2 hover:bg-[#eff0f6] w-[75px]">Delete</button>
                    </form>
                </div>
            </div>
            <div class="py-2 flex flex-col gap-3">
                <div class="px-5 mt-2 flex items-center">
                    <label class="font-semibold mr-2 py-[6px] min-w-[150px] self-start">Record
                        number</label>
                    <div class="flex flex-col grow">
                        <input
                            class="bg-transparent text-[#6b6f80] border border-[#e2e4ef] rounded-md h-[42px] px-3 py-1 focus:outline-none focus:border-[#9aa0ac] w-full"
                            value="{{ $record->id }}" disabled>
                    </div>
                </div>
                <div class="px-5 flex items-center">
                    <label class="font-semibold mr-2 py-[6px] min-w-[150px] self-start">Date</label>
                    <div class="flex flex-col grow">
                        <input
                            class="bg-transparent text-[#6b6f80] border border-[#e2e4ef] rounded-md h-[42px] px-3 py-1 focus:outline-none focus:border-[#9aa0ac] w-full"
                            value="{{ $record->date }}" disabled>
                    </div>
                </div>
                <div class="px-5 flex items-center">
                    <label class="font-semibold mr-2 py-[6px] min-w-[150px] self-start">Weekday</label>
                    <div class="flex flex-col grow">
                        <input
                            class="bg-transparent text-[#6b6f80] border border-[#e2e4ef] rounded-md h-[42px] px-3 py-1 focus:outline-none focus:border-[#9aa0ac] w-full"
                            value="{{ $record->week_day }}" disabled>
                    </div>
                </div>
                <div class="px-5 flex items-center">
                    <label class="font-semibold mr-2 py-[6px] min-w-[150px] self-start">User name</label>
                    <div class="flex flex-col grow">
                        <input
                            class="bg-transparent text-[#6b6f80] border border-[#e2e4ef] rounded-md h-[42px] px-3 py-1 focus:outline-none focus:border-[#9aa0ac] w-full"
                            value="{{ $record->user->first_name }} {{ $record->user->last_name }}" disabled>
                    </div>
                </div>
            </div>
        </div>
        <div class=" border rounded-md bg-white mb-6 mt-6">
            <div class="border-b flex justify-between p-4 items-center">
                <p class="font-semibold text-xl">Work Schedule</p>
            </div>

            <div class="py-2 flex flex-col gap-3">
                <div class="px-5 mt-2 flex items-center">
                    <label class="font-semibold mr-2 py-[6px] min-w-[150px] self-start">Morning start</label>
                    <div class="flex flex-col grow">
                        <input
                            class="bg-transparent text-[#6b6f80] border border-[#e2e4ef] rounded-md h-[42px] px-3 py-1 focus:outline-none focus:border-[#9aa0ac] w-full"
                            value="{{ $record->morning_start }}" disabled>
                    </div>
                </div>
                <div class="px-5 flex items-center">
                    <label class="font-semibold mr-2 py-[6px] min-w-[150px] self-start">Morning end</label>
                    <div class="flex flex-col grow">
                        <input
                            class="bg-transparent text-[#6b6f80] border border-[#e2e4ef] rounded-md h-[42px] px-3 py-1 focus:outline-none focus:border-[#9aa0ac] w-full"
                            value="{{ $record->morning_end }}" disabled>
                    </div>
                </div>
                <div class="px-5 flex items-center">
                    <label class="font-semibold mr-2 py-[6px] min-w-[150px] self-start">Afternoon start</label>
                    <div class="flex flex-col grow">
                        <input
                            class="bg-transparent text-[#6b6f80] border border-[#e2e4ef] rounded-md h-[42px] px-3 py-1 focus:outline-none focus:border-[#9aa0ac] w-full"
                            value="{{ $record->afternoon_start }}" disabled>
                    </div>
                </div>
                <div class="px-5 flex items-center">
                    <label class="font-semibold mr-2 py-[6px] min-w-[150px] self-start">Afternoon end</label>
                    <div class="flex flex-col grow">
                        <input
                            class="bg-transparent text-[#6b6f80] border border-[#e2e4ef] rounded-md h-[42px] px-3 py-1 focus:outline-none focus:border-[#9aa0ac] w-full"
                            value="{{ $record->afternoon_end }}" disabled>
                    </div>
                </div>
                <div class="px-5 flex items-center">
                    <label for="is_present" class="font-semibold mr-2 min-w-[150px] py-[6px] self-start">Presence</label>
                    <div class="flex flex-col grow">
                        @if ($record->is_present)
                            <button id="is_present" onclick=toggleCheckboxButton(this) type="button"
                                class="h-5 w-9 bg-[#CBCFD2] rounded-full border-2 border-transparent duration-[0.15s] buttonActive">
                                <span id="span_is_present"
                                    class="bg-white rounded-full h-4 w-4 block duration-[0.15s] checkbox checkboxActive"></span>
                            </button>
                        @else
                            <button id="is_present" onclick=toggleCheckboxButton(this) type="button"
                                class="h-5 w-9 bg-[#CBCFD2] rounded-full border-2 border-transparent duration-[0.15s]">
                                <span id="span_is_present"
                                    class="bg-white rounded-full h-4 w-4 block duration-[0.15s] checkbox"></span>
                            </button>
                        @endif
                    </div>
                </div>
            </div>
        </div>
        <div class=" border rounded-md bg-white mb-6 mt-6">
            <div class="border-b flex justify-between p-4 items-center">
                <p class="font-semibold text-xl">Uploaded File</p>
            </div>

            <div class="py-2 flex flex-col gap-3">
                <div class="px-5 my-2 flex flex-col items-start">
                    <div class="w-full">
                        @if ($record->file_location)
                            <a href="{{ $record->file_location }}" target="_blank"
                                class="font-semibold py-[6px] min-w-[150px] self-start rounded-md pl-4">{{ $record->file_name }}</a>
                        @else
                            <div class="font-semibold border py-[6px] min-w-[150px] self-start rounded-md pl-4"
                                id="file_holder">
                                No
                                file
                                uploaded
                            </div>
                        @endif
                    </div>
                    <div class="flex items-center mt-4">
                        <form action="{{ route('record.store.file', $record->id) }}" method="POST"
                            enctype="multipart/form-data">
                            @csrf
                            <button
                                class="hover:bg-[#ff7f31] bg-[#FF8B45] font-semibold rounded-md h-9 mr-4 px-6 text-white tracking-wider"
                                onclick=toggleBrowseFile() type="button">Browse
                                File</button>
                            <button
                                class="hover:bg-[#ff7f31] bg-[#FF8B45] font-semibold rounded-md h-9 px-6 text-white tracking-wider"
                                onclick=toggleShowFileName()>Upload
                                file</button>
                            <input type="file" id="file_input" accept="application/pdf" name="file_upload"
                                class="hidden" onchange=toggleFileHolder()>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <div class=" border rounded-md bg-white mb-6 mt-6">
            <div class="border-b flex justify-between p-4 items-center">
                <p class="font-semibold text-xl">Notes</p>
            </div>
            <div class="pt-2 pb-4 flex flex-col gap-3">
                <form action="{{ route('record.store.notes', $record->id) }}" method="POST">
                    <div class="px-5 my-2 flex flex-col items-start">
                        @csrf
                        <textarea name="notes" cols="100" rows="10"
                            class="bg-transparent p-3 border rounded-md focus:outline-none focus:border-[#e5e7eb] w-full"> {{ $record->notes ? $record->notes : '' }}</textarea>
                        <button
                            class="hover:bg-[#ff7f31] bg-[#FF8B45] font-semibold rounded-md h-9 px-6 mt-4 text-white tracking-wider">Save
                            notes</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    </div>
    </div>
    <script>
        function toggleBrowseFile() {
            input = document.getElementById("file_input")
            input.click()
        }

        function toggleFileHolder() {
            input = document.getElementById("file_input")
            file_holder = document.getElementById("file_holder")
            result = input.value.split("\\")
            file_holder.textContent = result[2]
        }
    </script>
@endsection
