@extends('layouts.layout')

@section('content')
    <div class="py-10 px-5 w-full">
        <div class="flex justify-between">
            <div>
                <div class="uppercase text-2xl font-semibold ">Record #{{ $record[0]->id }}</div>
                <div class="text-xl ">{{ $record[0]->date }}, {{ $record[0]->week_day }}</div>
            </div>
            <div class="flex gap-3">
                <a class="uppercase bg-orange-400 rounded-md px-8 py-1 my-5"
                    href="{{ route('record.update', $record[0]->id) }}">Update</a>
                <form action="{{ route('record.destroy', $record[0]->id) }}" method="POST">
                    @method('delete')
                    @csrf
                    <button class="uppercase bg-orange-400 rounded-md px-8 py-1 my-5">Delete</button>
                </form>
            </div>
        </div>
        <hr class="border-black border-[1px] mt-1 mb-5">
        <div>
            <div class="uppercase text-xl font-semibold">User information</div>
            <div class="flex gap-3">
                <div class="text-lg">Name: {{ $record[0]->user->name }}</div>
                <div class="text-lg">Email: {{ $record[0]->user->email }}</div>
            </div>

        </div>
        <hr class="border-black border-[1px] my-1 mb-5">
        <div>
            <div class="uppercase text-xl font-semibold">Work schedule</div>
            <div>
                <div class="flex gap-8">
                    <div>
                        <div>Morning Start: {{ $record[0]->morning_start }} </div>
                        <div>Morning End: {{ $record[0]->morning_end }}</div>
                    </div>
                    <div>
                        <div>Afternoon Start: {{ $record[0]->afternoon_start }}</div>
                        <div>Afternoon End: {{ $record[0]->afternoon_end }}</div>
                    </div>
                </div>
            </div>
            <div>Present: <input type="checkbox" {{ $record[0]->is_present ? 'checked' : '' }} disabled></div>

        </div>
        <hr class="border-black border-[1px] my-1 mb-5">
        <div>
            <div class="uppercase text-xl font-semibold">Uploaded Files</div>
            <div>
                @if ($record[0]->file_location)
                    <a href="{{ $record[0]->file_location }}" target="_blank">{{ $record[0]->file_name }}</a>
                @else
                    <p>No file uploaded</p>
                @endif
            </div>

            <form action="{{ route('record.store.file', $record[0]->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                <input type="file" id="file_upload" accept="application/pdf" name="file_upload">
                <button class="uppercase bg-orange-400 rounded-md px-8 py-1 my-5">Upload</button>
            </form>

        </div>
        <hr class="border-black border-[1px] my-1 mb-5">
        <div>
            <div class="uppercase text-xl font-semibold">Notes</div>



            <form action="{{ route('record.store.notes', $record[0]->id) }}" method="POST">
                @csrf
                <textarea name="notes" id="" cols="100" rows="10" class="w-full"> {{ $record[0]->notes ? $record[0]->notes : '' }}</textarea>
                <button class="uppercase bg-orange-400 rounded-md px-8 py-1 my-5">Add notes</button>
            </form>
        </div>
    </div>
@endsection
