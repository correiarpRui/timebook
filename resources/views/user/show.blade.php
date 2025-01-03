@extends('layouts.layout')

@section('content')
    <div class="text-[#fafafa]">
        <ol class="flex items-center p-2 gap-1">
            <li>
                <a href="{{ route('users') }}" class="text-[#a1a1aa] hover:text-[#fafafa]">Users</a>
            </li>
            <li>
                <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 21 21" fill="none"
                    stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                    class="lucide lucide-chevron-right text-[#a1a1aa]">
                    <path d="m9 18 6-6-6-6"></path>
                </svg>
            </li>
            <li>
                <a href="{{ route('user.update', $user->id) }}">View</a>
            </li>
            <li>
                <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 21 21" fill="none"
                    stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                    class="lucide lucide-chevron-right text-[#a1a1aa]">
                    <path d="m9 18 6-6-6-6"></path>
                </svg>
            </li>
            <li>
                <div>{{ $user->first_name }} {{ $user->last_name }}</div>
            </li>
        </ol>
        <div class="p-6">
            <div class="text-2xl font-bold tracking-tight text-[#fafafa]">
                User Information
            </div>
            <hr class="my-[12px] border-[#27272a]">
            <div class="flex flex-col gap-4">
                <div class="flex flex-col gap-1">
                    <div class="text-sm font-medium">First name</div>
                    <div
                        class="bg-transparent border border-[#27272a] rounded-md h-9 px-3 py-1 focus:outline-none focus:border-[#e5e7eb]">
                        {{ $user->first_name }}
                    </div>
                </div>
                <div class="flex flex-col gap-1">
                    <div class="text-sm font-medium">Last name</div>
                    <div
                        class="bg-transparent border border-[#27272a] rounded-md h-9 px-3 py-1 focus:outline-none focus:border-[#e5e7eb]">
                        {{ $user->last_name }}
                    </div>
                </div>
                <div class="flex flex-col gap-1">
                    <div class="text-sm font-medium">Email</div>
                    <div
                        class="bg-transparent border border-[#27272a] rounded-md h-9 px-3 py-1 focus:outline-none focus:border-[#e5e7eb]">
                        {{ $user->email }}
                    </div>
                </div>
                <div class="flex flex-col gap-1">
                    <div class="text-sm font-medium">Date of birth</div>
                    <div
                        class="bg-transparent border border-[#27272a] rounded-md h-9 px-3 py-1 focus:outline-none focus:border-[#e5e7eb]">
                        {{ $user->birth_date }}
                    </div>
                </div>
            </div>
            <div class="text-2xl font-bold tracking-tight text-[#fafafa] mt-6">
                User vacations
            </div>
            <hr class="my-[12px] border-[#27272a]">
            <div class="flex flex-col gap-4">
                <div class="flex flex-col gap-1">
                    <div class="text-sm font-medium">Yearly vacation days</div>
                    <div
                        class="bg-transparent border border-[#27272a] rounded-md h-9 px-3 py-1 focus:outline-none focus:border-[#e5e7eb]">
                        22
                    </div>
                </div>
            </div>

        </div>
    </div>
@endsection
