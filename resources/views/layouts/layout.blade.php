<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <title>Document</title>
</head>

{{-- <a href="{{ route('calendar', date('Y')) }}">Calendar</a> --}}


<body class="bg-[#09090b] font-roboto">
    <div
        class="grid grid-cols-[auto_1fr] border-[#27272a] m-6 border rounded-md box-border h-[calc(100vh-48px)] sticky  top-0 self-start overflow-auto">
        <nav
            class=" flex h-[calc(100vh-50px)] w-[250px] box-border py-6 px-4 bg-[#09090b] border-r border-[#27272a] text-[#fafafa] sticky top-0 self-start ">
            <ul class="grow flex flex-col gap-1">
                <li>
                    <a @class([
                        'rounded-md p-2 text-[#fafafa] flex items-center gap-1 hover:bg-[#27272a]',
                        'bg-[#27272a]' => request()->routeIs('dashboard*'),
                    ]) href="{{ route('dashboard.index') }} ">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                            stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="mr-2 h-4 w-4">
                            <rect width="7" height="7" x="3" y="3" rx="1"></rect>
                            <rect width="7" height="7" x="14" y="3" rx="1"></rect>
                            <rect width="7" height="7" x="14" y="14" rx="1"></rect>
                            <rect width="7" height="7" x="3" y="14" rx="1"></rect>
                        </svg>
                        <span class="grow">Dashboard</span>
                    </a>
                </li>
                <li>
                    <a @class([
                        'rounded-md p-2 text-[#fafafa] flex items-center gap-1 hover:bg-[#27272a]',
                        'bg-[#27272a]' => request()->routeIs('records*'),
                    ]) href="{{ route('records') }}">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                            fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                            stroke-linejoin="round" class="lucide lucide-inbox mr-2 h-4 w-4">
                            <polyline points="22 12 16 12 14 15 10 15 8 12 2 12"></polyline>
                            <path
                                d="M5.45 5.11 2 12v6a2 2 0 0 0 2 2h16a2 2 0 0 0 2-2v-6l-3.45-6.89A2 2 0 0 0 16.76 4H7.24a2 2 0 0 0-1.79 1.11z">
                            </path>
                        </svg>
                        <span class="grow">Records</span>
                    </a>
                </li>
                <li>
                    <button
                        class='rounded-md p-2 text-[#fafafa] flex w-full text-left items-center gap-1 hover:bg-[#27272a] cursor-pointer'
                        onclick=toggleSubMenuDropDown(this)>
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                            fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                            stroke-linejoin="round" class="lucide lucide-calendar mr-2 h-4 w-4">
                            <path d="M8 2v4"></path>
                            <path d="M16 2v4"></path>
                            <rect width="18" height="18" x="3" y="4" rx="2"></rect>
                            <path d="M3 10h18"></path>
                        </svg>
                        <span class="grow">Calendar</span>
                        <svg class="flex-shrink-0" xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                            viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                            stroke-linecap="round" stroke-linejoin="round"
                            class="lucide lucide-chevron-down text-muted-foreground">
                            <path d="m6 9 6 6 6-6"></path>
                        </svg>
                    </button>
                    <ul @class(['grid submenu', 'show' => request()->routeIs('calendar*')])>
                        <div class=" overflow-hidden">
                            <li>
                                <a @class([
                                    'rounded-md py-2 pr-2 pl-6  text-[#fafafa] flex items-center gap-1 hover:bg-[#27272a] mt-1',
                                    'bg-[#27272a]' => request()->routeIs('calendar.year*'),
                                ]) href="{{ route('calendar.year', date('Y')) }}">Year</a>
                            </li>
                            <li>
                                <a @class([
                                    'rounded-md py-2 pr-2 pl-6  text-[#fafafa] flex items-center gap-1 hover:bg-[#27272a] mt-1',
                                    'bg-[#27272a]' => request()->routeIs('calendar.month*'),
                                ])
                                    href="{{ route('calendar.month', [date('Y'), date('m')]) }}">Month</a>
                            </li>
                            <li>
                                <a @class([
                                    'rounded-md py-2 pr-2 pl-6  text-[#fafafa] flex items-center gap-1 hover:bg-[#27272a] mt-1',
                                    'bg-[#27272a]' => request()->routeIs('calendar.vacation*'),
                                ])
                                    href="{{ route('calendar.vacation', [date('Y')]) }}">Vacations</a>
                            </li>
                            <li>
                                <a @class([
                                    'rounded-md py-2 pr-2 pl-6  text-[#fafafa] flex items-center gap-1 hover:bg-[#27272a] mt-1',
                                    'bg-[#27272a]' => request()->routeIs('calendar.settings*'),
                                ])
                                    href="{{ route('calendar.settings', date('Y')) }}">Settings</a>
                            </li>
                        </div>
                    </ul>
                </li>
                <li>
                    <button
                        class='rounded-md p-2 text-[#fafafa] flex w-full text-left items-center gap-1 hover:bg-[#27272a] cursor-pointer'
                        onclick=toggleSubMenuDropDown(this)>
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                            stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            class="h-4 w-4 mr-2 text-muted-foreground">
                            <rect width="20" height="14" x="2" y="5" rx="2"></rect>
                            <path d="M2 10h20"></path>
                        </svg>
                        <span class="grow">Schedules</span>
                        <svg class="flex-shrink-0" xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                            viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                            stroke-linecap="round" stroke-linejoin="round"
                            class="lucide lucide-chevron-down text-muted-foreground">
                            <path d="m6 9 6 6 6-6"></path>
                        </svg>
                    </button>
                    <ul @class(['grid submenu', 'show' => request()->routeIs('schedule*')])>
                        <div class=" overflow-hidden">
                            <li>
                                <a @class([
                                    'rounded-md py-2 pr-2 pl-6  text-[#fafafa] flex items-center gap-1 hover:bg-[#27272a] mt-1',
                                    'bg-[#27272a]' => request()->routeIs('schedule.planner*'),
                                ])
                                    href="{{ route('schedule.planner', [date('Y'), date('m')]) }}">Planner</a>
                            </li>
                            <li>
                                <a @class([
                                    'rounded-md py-2 pr-2 pl-6  text-[#fafafa] flex items-center gap-1 hover:bg-[#27272a] mt-1',
                                    'bg-[#27272a]' => request()->routeIs('schedule.list*'),
                                ]) href="{{ route('schedule.list') }}">Schedule</a>
                            </li>
                        </div>
                    </ul>
                </li>
                <li>
                    <a @class([
                        'rounded-md p-2 text-[#fafafa] flex items-center gap-1 hover:bg-[#27272a]',
                        'bg-[#27272a]' => request()->routeIs('user*'),
                    ]) href="{{ route('users') }}">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                            fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                            stroke-linejoin="round" class="lucide lucide-users-round mr-2 h-4 w-4">
                            <path d="M18 21a8 8 0 0 0-16 0"></path>
                            <circle cx="10" cy="8" r="5"></circle>
                            <path d="M22 20c0-3.37-2-6.5-4-8a5 5 0 0 0-.45-8.3"></path>
                        </svg>
                        <span class="grow">Users</span>
                    </a>
                </li>
                <li class="mt-auto">
                    <ul class="grid submenu">
                        <div class=" overflow-hidden">
                            <li>
                                <a class="rounded-md py-2 pr-2 pl-6 text-[#fafafa] flex items-center gap-1 hover:bg-[#27272a]"
                                    href="{{ route('profile.show', auth()->user()->id) }}">
                                    <span class="grow">Profile</span>
                                </a>
                            </li>
                            <li>
                                <a class="rounded-md py-2 pr-2 pl-6 text-[#fafafa] flex items-center gap-1 hover:bg-[#27272a]"
                                    href="{{ route('logout') }}">
                                    <span class="grow">Logout</span>
                                </a>
                            </li>
                        </div>
                    </ul>
                    <button
                        class="rounded-md p-2 text-[#fafafa] flex w-full text-left items-center gap-1 hover:bg-[#27272a] cursor-pointer"
                        onclick=toggleSubMenuDropUp(this)>
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                            fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                            stroke-linejoin="round" class="lucide lucide-ellipsis-vertical h-4 w-4 mr-2 rotate-90">
                            <circle cx="12" cy="12" r="1"></circle>
                            <circle cx="12" cy="5" r="1"></circle>
                            <circle cx="12" cy="19" r="1"></circle>
                        </svg>
                        <span class="grow">More</span>
                        <svg class="flex-shrink-0 rotate-180" xmlns="http://www.w3.org/2000/svg" width="16"
                            height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                            stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                            class="lucide lucide-chevron-down text-muted-foreground">
                            <path d="m6 9 6 6 6-6"></path>
                        </svg>
                    </button>

                </li>
            </ul>
        </nav>

        @yield('content')

    </div>

</body>

</html>

<script>
    function toggleSubMenuDropDown(button) {
        button.nextElementSibling.classList.toggle("show");
        button.classList.toggle('rotate')
    }

    function toggleSubMenuDropUp(button) {
        button.previousElementSibling.classList.toggle("show");
        button.classList.toggle('rotate')
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
