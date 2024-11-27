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
                <a href="{{ route('record.show', $record[0]->id) }}" class="text-[#a1a1aa]">Record {{ $record[0]->id }}</a>
            </li>
            <li>
                <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 21 21" fill="none"
                    stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                    class="lucide lucide-chevron-right text-[#a1a1aa]">
                    <path d="m9 18 6-6-6-6"></path>
                </svg>
            </li>
            <li>
                <a href="{{ route('record.update', $record[0]->id) }}">Update record</a>
            </li>
        </ol>
        <div class="p-6">
            <div class="text-2xl font-bold tracking-tight text-[#fafafa]">
                Update Record #{{ $record[0]->id }}
            </div>
            <hr class="my-[12px] border-[#27272a]">
            <form action="{{ route('record.patch', $record[0]->id) }}" method="POST" class="flex flex-col gap-4">
                @csrf
                @method('PATCH')
                <div class="flex flex-col gap-1">
                    <label for="morning_start" class="text-sm font-medium">Morning start</label>
                    <input
                        class="bg-transparent border border-[#27272a] rounded-md h-9 px-3 py-1 focus:outline-none focus:border-[#e5e7eb]"
                        type="time" name="morning_start" value="{{ $record[0]->morning_start }}">
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
                        type="time" name="morning_end" value="{{ $record[0]->morning_end }}">
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
                        type="time" name="afternoon_start" value="{{ $record[0]->afternoon_start }}">
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
                        type="time" name="afternoon_end" value="{{ $record[0]->afternoon_end }}">
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
                <div class="flex py-4 px-6 border border-[#27272a] rounded-md justify-between select-none">
                    <label class="cursor-pointer select-none" for="is_present">Presence</label>
                    <button id="is_present" onclick=toggleCheckboxButton(this) type="button"
                        class="h-5 w-9 bg-[#27272a] rounded-full border-2 border-transparent duration-[0.15s] {{ $record[0]->is_present ? 'buttonActive' : '' }}">
                        <span id="span_is_present"
                            class="bg-[#09090b] rounded-full h-4 w-4 block duration-[0.15s] {{ $record[0]->is_present ? 'checkboxActive' : '' }}"></span>
                    </button>
                    <input type="checkbox" name="is_present" id="checkbox_is_present" class="hidden"
                        {{ $record[0]->is_present ? 'checked' : '' }}>
                </div>
                <button class="bg-[#fafafa] text-[#09090b] font-medium rounded-md h-9 mr-auto px-6 text-sm">Update
                    Record</button>
            </form>
        </div>
    </div>
@endsection
