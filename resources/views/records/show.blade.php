@extends('layouts.layout')

@section('content')
    <div class="text-[#fafafa]">
        <ol class="flex items-center p-2 gap-1">
            <li>
                <a href="{{ route('records') }}" class="text-[#a1a1aa] hover:text-[#fafafa]">Records</a>
            </li>
            <li>
                <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 21 21" fill="none"
                    stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                    class="lucide lucide-chevron-right text-[#a1a1aa]">
                    <path d="m9 18 6-6-6-6"></path>
                </svg>
            </li>
            <li>
                <a href="{{ route('record.show', $record->id) }}">Record {{ $record->id }}</a>
            </li>
        </ol>
        <div class="p-6">
            <div class="flex justify-between">
                <div>
                    <div class="text-2xl font-bold tracking-tight text-[#fafafa]">Record #{{ $record->id }}</div>
                    <div class="text-sm font-semibold text-[#a1a1aa]">{{ $record->date }},
                        {{ $record->week_day }}</div>
                </div>
                <div class="flex gap-2">
                    <a class="bg-[#fafafa] text-[#09090b] items-center rounded-md px-4 py-2 cursor-pointer text-sm font-medium h-9 w-20 text-center"
                        href="{{ route('record.update', $record->id) }}">Edit</a>
                    <form action="{{ route('record.destroy', $record->id) }}" method="POST">
                        @method('delete')
                        @csrf
                        <button
                            class="bg-[#fafafa] text-[#DC2626] items-center rounded-md px-4 py-2 cursor-pointer text-sm font-medium h-9 w-20 text-center">Delete</button>
                    </form>
                </div>
            </div>
            <hr class="my-[12px] border-[#27272a]">
            <div class="text-lg font-medium pr-2">User Information</div>
            <div class="flex flex-col gap-1 mb-4">
                <div class="text-sm font-medium">Name</div>
                <div
                    class="bg-transparent border border-[#27272a] rounded-md h-9 px-3 py-1 focus:outline-none focus:border-[#e5e7eb]">
                    {{ $record->user->first_name }} {{ $record->user->last_name }}
                </div>
            </div>
            <div class="flex flex-col gap-1 mb-4">
                <div class="text-sm font-medium">Email</div>
                <div
                    class="bg-transparent border border-[#27272a] rounded-md h-9 px-3 py-1 focus:outline-none focus:border-[#e5e7eb]">
                    {{ $record->user->email }}
                </div>
            </div>
            <hr class="my-[12px] border-[#27272a]">
            <div class="text-lg font-medium pr-2">Work Schedule</div>
            <div class="flex flex-col gap-1 mb-4">
                <div class="text-sm font-medium">Morning start</div>
                <div
                    class="bg-transparent border border-[#27272a] rounded-md h-9 px-3 py-1 focus:outline-none focus:border-[#e5e7eb]">
                    {{ $record->morning_start }}
                </div>
            </div>
            <div class="flex flex-col gap-1 mb-4">
                <div class="text-sm font-medium">Morning end</div>
                <div
                    class="bg-transparent border border-[#27272a] rounded-md h-9 px-3 py-1 focus:outline-none focus:border-[#e5e7eb]">
                    {{ $record->morning_end }}
                </div>
            </div>
            <div class="flex flex-col gap-1 mb-4">
                <div class="text-sm font-medium">Afternoon start</div>
                <div
                    class="bg-transparent border border-[#27272a] rounded-md h-9 px-3 py-1 focus:outline-none focus:border-[#e5e7eb]">
                    {{ $record->afternoon_start }}
                </div>
            </div>
            <div class="flex flex-col gap-1 mb-4">
                <div class="text-sm font-medium">Afternoon end</div>
                <div class="bg-transparent border border-[#27272a] rounded-md h-9 px-3 py-1">
                    {{ $record->afternoon_end }}
                </div>
            </div>
            <div class="flex flex-col gap-1 mb-4">
                @if ($record->is_present)
                    <div class="flex mb-3 py-4 px-6 border border-[#27272a] rounded-md justify-between select-none">
                        <div class="text-sm font-medium">Presence</div>
                        <button class="h-5 w-9 bg-[#fafafa] rounded-full border-2 border-transparent">
                            <span id="span_monday" class="bg-[#09090b] rounded-full h-4 w-4 block translate-x-4"></span>
                        </button>
                    </div>
                @else
                    <div class="flex mb-3 py-4 px-6 border border-[#27272a] rounded-md justify-between select-none">
                        <div class="text-sm font-medium">Presence</div>
                        <button class="h-5 w-9 bg-[#27272a] rounded-full border-2 border-transparent">
                            <span id="span_monday" class="bg-[#09090b] rounded-full h-4 w-4 block"></span>
                        </button>
                    </div>
                @endif
            </div>
            <hr class="my-[12px] border-[#27272a]">
            <div class="text-lg font-medium pr-2">Uploaded Files</div>
            <div class="flex mb-1 py-4 px-6 border border-[#27272a] rounded-md justify-between">
                @if ($record->file_location)
                    <a href="{{ $record->file_location }}" target="_blank"
                        class="text-sm font-medium">{{ $record->file_name }}</a>
                @else
                    <div class="text-sm font-medium" id="file_holder">No file uploaded</div>
                @endif
            </div>
            <form action="{{ route('record.store.file', $record->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                <button class="bg-[#fafafa] text-[#09090b] font-medium rounded-md h-9 mr-auto mt-2 px-6 text-sm"
                    onclick=toggleBrowseFile() type="button">Browse
                    File</button>
                <button class="bg-[#fafafa] text-[#09090b] font-medium rounded-md h-9 mr-auto mt-2 px-6 text-sm"
                    onclick=toggleShowFileName()>Upload
                    file</button>
                <input type="file" id="file_input" accept="application/pdf" name="file_upload" class="hidden"
                    onchange=toggleFileHolder()>
            </form>
            <hr class="my-[12px] border-[#27272a]">
            <div class="text-lg font-medium pr-2">Notes</div>
            <form action="{{ route('record.store.notes', $record->id) }}" method="POST">
                @csrf
                <textarea name="notes" id="" cols="100" rows="10"
                    class="w-full bg-transparent p-3 border border-[#27272a] rounded-md focus:outline-none focus:border-[#e5e7eb]"> {{ $record->notes ? $record->notes : '' }}</textarea>
                <button class="bg-[#fafafa] text-[#09090b] font-medium rounded-md h-9 mr-auto mt-2 px-6 text-sm">Save
                    notes</button>
            </form>
        </div>
    </div>
@endsection

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
