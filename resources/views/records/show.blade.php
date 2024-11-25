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
                <a href="{{ route('record.show', $record[0]->id) }}">Record {{ $record[0]->id }}</a>
            </li>
        </ol>
        <div class="p-6">
            <div>
                <div class="text-2xl font-bold tracking-tight text-[#fafafa]">Record #{{ $record[0]->id }}</div>
                <div class="text-sm font-semibold text-[#a1a1aa]">{{ $record[0]->date }},
                    {{ $record[0]->week_day }}</div>
            </div>
            <hr class="my-[12px] border-[#27272a]">
            <div class="text-lg font-medium pr-2">User Information</div>
            <div class="flex flex-col gap-1 mb-4">
                <div class="text-sm font-medium">Name</div>
                <div
                    class="bg-transparent border border-[#27272a] rounded-md h-9 px-3 py-1 focus:outline-none focus:border-[#e5e7eb]">
                    {{ $record[0]->user->name }}
                </div>
            </div>
            <div class="flex flex-col gap-1 mb-4">
                <div class="text-sm font-medium">Email</div>
                <div
                    class="bg-transparent border border-[#27272a] rounded-md h-9 px-3 py-1 focus:outline-none focus:border-[#e5e7eb]">
                    {{ $record[0]->user->email }}
                </div>
            </div>
            <hr class="my-[12px] border-[#27272a]">
            <div class="text-lg font-medium pr-2">Work Schedule</div>
            <div class="flex flex-col gap-1 mb-4">
                <div class="text-sm font-medium">Morning start</div>
                <div
                    class="bg-transparent border border-[#27272a] rounded-md h-9 px-3 py-1 focus:outline-none focus:border-[#e5e7eb]">
                    {{ $record[0]->morning_start }}
                </div>
            </div>
            <div class="flex flex-col gap-1 mb-4">
                <div class="text-sm font-medium">Morning end</div>
                <div
                    class="bg-transparent border border-[#27272a] rounded-md h-9 px-3 py-1 focus:outline-none focus:border-[#e5e7eb]">
                    {{ $record[0]->morning_end }}
                </div>
            </div>
            <div class="flex flex-col gap-1 mb-4">
                <div class="text-sm font-medium">Afternoon start</div>
                <div
                    class="bg-transparent border border-[#27272a] rounded-md h-9 px-3 py-1 focus:outline-none focus:border-[#e5e7eb]">
                    {{ $record[0]->afternoon_start }}
                </div>
            </div>
            <div class="flex flex-col gap-1 mb-4">
                <div class="text-sm font-medium">Afternoon end</div>
                <div class="bg-transparent border border-[#27272a] rounded-md h-9 px-3 py-1">
                    {{ $record[0]->afternoon_end }}
                </div>
            </div>
            <div class="flex flex-col gap-1 mb-4">
                @if ($record[0]->is_present)
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
                @if ($record[0]->file_location)
                    <a href="{{ $record[0]->file_location }}" target="_blank"
                        class="text-sm font-medium">{{ $record[0]->file_name }}</a>
                @else
                    <div class="text-sm font-medium" id="file_holder">No file uploaded</div>
                @endif
            </div>
            <form action="{{ route('record.store.file', $record[0]->id) }}" method="POST" enctype="multipart/form-data">
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
            <form action="{{ route('record.store.notes', $record[0]->id) }}" method="POST">
                @csrf
                <textarea name="notes" id="" cols="100" rows="10"
                    class="w-full bg-transparent p-3 border border-[#27272a] rounded-md focus:outline-none focus:border-[#e5e7eb]"> {{ $record[0]->notes ? $record[0]->notes : '' }}</textarea>
                <button class="bg-[#fafafa] text-[#09090b] font-medium rounded-md h-9 mr-auto mt-2 px-6 text-sm "
                    onclick=toggleShowFileName()>Upload
                    file</button>
            </form>
        </div>
    </div>
    {{-- <div class="flex gap-3">
                    <a class="uppercase bg-orange-400 rounded-md px-8 py-1 my-5"
                        href="{{ route('record.update', $record[0]->id) }}">Update</a>
                    <form action="{{ route('record.destroy', $record[0]->id) }}" method="POST">
                        @method('delete')
                        @csrf
                        <button class="uppercase bg-orange-400 rounded-md px-8 py-1 my-5">Delete</button>
                    </form>
                </div> --}}
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
