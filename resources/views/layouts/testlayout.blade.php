<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <title>Document</title>
</head>

<body class="bg-white text-[#454e60]">
    <div class="page ">
        {{-- Header --}}
        <div class="fixed w-full header bg-white border-b z-10 border-[#eff0f6] flex">
            <div class="w-[250px] flex pl-[20px] border-[#eff0f6] border-r h-[70px] items-center justify-center">
                <span class="font-semibold text-3xl">Logo</span>
            </div>
            <div class="flex grow justify-end pr-[40px] bg-white h-[70px] items-center">
                <div class="profile_menu_btn size-[40px] bg-[#ff7f31] rounded-full flex items-center justify-center cursor-pointer relative"
                    onclick="toggle_profile_menu('profile_menu')" id="profile_menu_btn">

                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                        fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                        stroke-linejoin="round" class="lucide lucide-user-round pointer-events-none text-white">
                        <circle cx="12" cy="8" r="5" />
                        <path d="M20 21a8 8 0 0 0-16 0" />
                    </svg>

                    <div class="profile_menu absolute w-[150px] right-0 top-[55px] border border-[#eff0f6] bg-white rounded-md"
                        id="profile_menu">
                        <div class="flex flex-col items-center pt-3 pb-2 border-b border-[#eff0f6]">
                            <div class="font-lg font-semibold">
                                {{ Auth::user()->first_name }} {{ Auth::user()->last_name }}
                            </div>
                            <div class="font-sm">
                                {{ Auth::user()->load(['role'])->role->role }}
                            </div>
                        </div>
                        <a href="{{ route('profile.show', auth()->user()->id) }}"
                            class="flex justify-start gap-2 items-center pl-4 py-3 border-b border-[#eff0f6] hover:bg-[#eff0f6]">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24"
                                fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                stroke-linejoin="round" class="lucide lucide-user">
                                <path d="M19 21v-2a4 4 0 0 0-4-4H9a4 4 0 0 0-4 4v2" />
                                <circle cx="12" cy="7" r="4" />
                            </svg>
                            <span>Profile</span>
                        </a>
                        <a href="{{ route('logout') }}"
                            class="flex justify-start gap-2 items-center pl-4 py-3 hover:bg-[#eff0f6]">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24"
                                fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                stroke-linejoin="round" class="lucide lucide-log-out">
                                <path d="M9 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h4" />
                                <polyline points="16 17 21 12 16 7" />
                                <line x1="21" x2="9" y1="12" y2="12" />
                            </svg>
                            <span>Sign out</span>
                        </a>
                    </div>
                </div>
            </div>
        </div>
        {{-- Sidebar --}}
        <div class="w-[250px] bg-white h-full pt-[70px] fixed border-r border-[#eff0f6] overflow-auto sidebar">

            <div class="side_bar p-5 flex flex-col gap-1">
                {{-- Dashboard --}}
                <a href=""
                    class="sub_menu flex gap-2 items-center text-center hover:bg-[#eff0f6] px-2 py-1 rounded-md">
                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24"
                        fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                        stroke-linejoin="round" class="lucide lucide-layout-dashboard">
                        <rect width="7" height="9" x="3" y="3" rx="1" />
                        <rect width="7" height="5" x="14" y="3" rx="1" />
                        <rect width="7" height="9" x="14" y="12" rx="1" />
                        <rect width="7" height="5" x="3" y="16" rx="1" />
                    </svg>
                    <span>Dashboard</span>
                </a>
                {{-- Records --}}
                <a href="{{ route('records') }}" @class([
                    'sub_menu flex gap-2 items-center text-center hover:bg-[#eff0f6] px-2 py-1 rounded-md',
                    'bg-[#eff0f6]' => request()->routeIs('records*'),
                ])>
                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24"
                        fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                        stroke-linejoin="round" class="lucide lucide-inbox">
                        <polyline points="22 12 16 12 14 15 10 15 8 12 2 12"></polyline>
                        <path
                            d="M5.45 5.11 2 12v6a2 2 0 0 0 2 2h16a2 2 0 0 0 2-2v-6l-3.45-6.89A2 2 0 0 0 16.76 4H7.24a2 2 0 0 0-1.79 1.11z">
                        </path>
                    </svg>
                    <span>Records</span>
                </a>
                {{-- Calendar --}}
                <div class="sub_menu">
                    <div class="flex gap-2 items-center justify-between text-center hover:bg-[#eff0f6] px-2 py-1 rounded-md cursor-pointer"
                        onclick="toggle_dropdown_menu(this)">
                        <div class="flex gap-2 cursor-pointer">
                            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20"
                                viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-calendar">
                                <path d="M8 2v4"></path>
                                <path d="M16 2v4"></path>
                                <rect width="18" height="18" x="3" y="4" rx="2"></rect>
                                <path d="M3 10h18"></path>
                            </svg>
                            <span>Calendar</span>
                        </div>
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24"
                            fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                            stroke-linejoin="round" class="lucide lucide-chevron-righx">
                            <path d="m9 18 6-6-6-6" />
                        </svg>
                    </div>
                    <div @class(['slide grid', 'show' => request()->routeIs('calendar*')])>
                        <div class="overflow-hidden">
                            <div class="px-2 py-1 flex flex-col gap-1">
                                <a href="{{ route('calendar.year', date('Y')) }}" @class([
                                    'px-2 py-1 rounded-md hover:bg-[#eff0f6]',
                                    'bg-[#eff0f6]' => request()->routeIs('calendar.year*'),
                                ])
                                    class="px-2 py-1 rounded-md hover:bg-[#eff0f6]">Year</a>
                                <a href="{{ route('calendar.month', [date('Y'), (int) date('m')]) }}"
                                    @class([
                                        'px-2 py-1 rounded-md hover:bg-[#eff0f6]',
                                        'bg-[#eff0f6]' => request()->routeIs('calendar.month*'),
                                    ])
                                    class="px-2 py-1 rounded-md hover:bg-[#eff0f6]">Month</a>
                                <a href="{{ route('calendar.vacation', date('Y')) }}"
                                    @class([
                                        'px-2 py-1 rounded-md hover:bg-[#eff0f6]',
                                        'bg-[#eff0f6]' => request()->routeIs('calendar.vacation*'),
                                    ])>Vacations</a>
                                <a href="{{ route('calendar.holidays', date('Y')) }}"
                                    @class([
                                        'px-2 py-1 rounded-md hover:bg-[#eff0f6]',
                                        'bg-[#eff0f6]' => request()->routeIs('calendar.holidays*'),
                                    ])>Holidays</a>
                            </div>
                        </div>
                    </div>
                </div>
                {{-- Schedules --}}
                <div class="sub_menu">
                    <div class="flex items-center justify-between text-center hover:bg-[#eff0f6] px-2 py-1 rounded-md cursor-pointer"
                        onclick="toggle_dropdown_menu(this)">
                        <div class="flex gap-2 cursor-pointer">
                            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20"
                                viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-credit-card">
                                <rect width="20" height="14" x="2" y="5" rx="2" />
                                <line x1="2" x2="22" y1="10" y2="10" />
                            </svg>
                            <span>Schedules</span>
                        </div>
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24"
                            fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                            stroke-linejoin="round" class="lucide lucide-chevron-right">
                            <path d="m9 18 6-6-6-6" />
                        </svg>
                    </div>
                    <div @class(['slide grid', 'show' => request()->routeIs('schedule*')])>
                        <div class="overflow-hidden">
                            <div class="px-2 py-1 flex flex-col gap-1">
                                <div class="flex items-center justify-between text-center hover:bg-[#eff0f6] pl-2 py-1 rounded-md cursor-pointer"
                                    onclick="toggle_dropdown_menu(this)">
                                    <span>Planner</span>
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                        viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                        stroke-linecap="round" stroke-linejoin="round"
                                        class="lucide lucide-chevron-right">
                                        <path d="m9 18 6-6-6-6" />
                                    </svg>
                                </div>
                                <div @class([
                                    'slide grid',
                                    'show' => request()->routeIs('schedule.planner*'),
                                ])>
                                    <div class="overflow-hidden">
                                        <div class="pl-3 flex items-center">
                                            <ul class="flex flex-col gap-1 grow items-start">
                                                <li class="w-full"><a
                                                        href="{{ route('schedule.planner', [date('Y'), 1]) }}"
                                                        @if (isset($month_name) && $month_name == 'January') class='flex shrink-0 rounded-md py-1 pl-2 bg-[#eff0f6]'
            @else class='flex shrink-0 rounded-md py-1 pl-2 hover:bg-[#eff0f6]' @endif>January</a>
                                                </li>
                                                <li class="w-full"><a
                                                        href="{{ route('schedule.planner', [date('Y'), 2]) }}"
                                                        @if (isset($month_name) && $month_name == 'February') class='flex shrink-0 rounded-md py-1 pl-2 bg-[#eff0f6]'
                    @else 
                        class='flex shrink-0 rounded-md py-1 pl-2 hover:bg-[#eff0f6]' @endif>February</a>
                                                </li>
                                                <li class="w-full"><a
                                                        href="{{ route('schedule.planner', [date('Y'), 3]) }}"
                                                        @if (isset($month_name) && $month_name == 'March') class='flex shrink-0 rounded-md py-1 pl-2 bg-[#eff0f6]'
                    @else 
                        class='flex shrink-0 rounded-md py-1 pl-2 hover:bg-[#eff0f6]' @endif>March</a>
                                                </li>
                                                <li class="w-full"><a
                                                        href="{{ route('schedule.planner', [date('Y'), 4]) }}"
                                                        @if (isset($month_name) && $month_name == 'April') class='flex shrink-0 rounded-md py-1 pl-2 bg-[#eff0f6]'
                    @else 
                        class='flex shrink-0 rounded-md py-1 pl-2 hover:bg-[#eff0f6]' @endif>April</a>
                                                </li>
                                                <li class="w-full"><a
                                                        href="{{ route('schedule.planner', [date('Y'), 5]) }}"
                                                        @if (isset($month_name) && $month_name == 'May') class='flex shrink-0 rounded-md py-1 pl-2 bg-[#eff0f6]'
                    @else 
                        class='flex shrink-0 rounded-md py-1 pl-2 hover:bg-[#eff0f6]' @endif>May</a>
                                                </li>
                                                <li class="w-full"><a
                                                        href="{{ route('schedule.planner', [date('Y'), 6]) }}"
                                                        @if (isset($month_name) && $month_name == 'June') class='flex shrink-0 rounded-md py-1 pl-2 bg-[#eff0f6]'
                    @else 
                        class='flex shrink-0 rounded-md py-1 pl-2 hover:bg-[#eff0f6]' @endif>June</a>
                                                </li>
                                                <li class="w-full"><a
                                                        href="{{ route('schedule.planner', [date('Y'), 7]) }}"
                                                        @if (isset($month_name) && $month_name == 'July') class='flex shrink-0 rounded-md py-1 pl-2 bg-[#eff0f6]'
                    @else 
                        class='flex shrink-0 rounded-md py-1 pl-2 hover:bg-[#eff0f6]' @endif>July</a>
                                                </li>
                                                <li class="w-full"><a
                                                        href="{{ route('schedule.planner', [date('Y'), 8]) }}"
                                                        @if (isset($month_name) && $month_name == 'August') class='flex shrink-0 rounded-md py-1 pl-2 bg-[#eff0f6]'
                    @else 
                        class='flex shrink-0 rounded-md py-1 pl-2 hover:bg-[#eff0f6]' @endif>August</a>
                                                </li>
                                                <li class="w-full"><a
                                                        href="{{ route('schedule.planner', [date('Y'), 9]) }}"
                                                        @if (isset($month_name) && $month_name == 'September') class='flex shrink-0 rounded-md py-1 pl-2 bg-[#eff0f6]'
                    @else 
                        class='flex shrink-0 rounded-md py-1 pl-2 hover:bg-[#eff0f6]' @endif>September</a>
                                                </li>
                                                <li class="w-full"><a
                                                        href="{{ route('schedule.planner', [date('Y'), 10]) }}"
                                                        @if (isset($month_name) && $month_name == 'October') class='flex shrink-0 rounded-md py-1 pl-2 bg-[#eff0f6]'
                    @else 
                        class='flex shrink-0 rounded-md py-1 pl-2 hover:bg-[#eff0f6]' @endif>October</a>
                                                </li>
                                                <li class="w-full"><a
                                                        href="{{ route('schedule.planner', [date('Y'), 11]) }}"
                                                        @if (isset($month_name) && $month_name == 'November') class='flex shrink-0 rounded-md py-1 pl-2 bg-[#eff0f6]'
                    @else 
                        class='flex shrink-0 rounded-md py-1 pl-2 hover:bg-[#eff0f6]' @endif>November</a>
                                                </li>
                                                <li class="w-full"><a
                                                        href="{{ route('schedule.planner', [date('Y'), 12]) }}"
                                                        @if (isset($month_name) && $month_name == 'December') class='flex shrink-0 rounded-md py-1 pl-2 bg-[#eff0f6]'
                    @else 
                        class='flex shrink-0 rounded-md py-1 pl-2 hover:bg-[#eff0f6]' @endif>December</a>
                                                </li>
                                            </ul>
                                        </div>

                                    </div>
                                </div>

                                <a href="{{ route('schedules') }}" @class([
                                    'px-2 py-1 rounded-md hover:bg-[#eff0f6]',
                                    'bg-[#eff0f6]' => request()->routeIs('schedules*'),
                                ])>Schedules</a>
                            </div>
                        </div>
                    </div>
                </div>
                {{-- Users --}}
                <a href="{{ route('users') }}" @class([
                    'sub_menu flex gap-2 items-center text-center hover:bg-[#eff0f6] px-2 py-1 rounded-md',
                    'bg-[#eff0f6]' => request()->routeIs('user*'),
                ])>
                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24"
                        fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                        stroke-linejoin="round" class="lucide lucide-users-round">
                        <path d="M18 21a8 8 0 0 0-16 0"></path>
                        <circle cx="10" cy="8" r="5"></circle>
                        <path d="M22 20c0-3.37-2-6.5-4-8a5 5 0 0 0-.45-8.3"></path>
                    </svg>
                    <span>Users</span>
                </a>
            </div>
        </div>
        {{-- Main Content --}}
        <div class="bg-[#edeef5] ml-[250px] pt-[70px] flex flex-col min-h-screen">
            @yield('content')
        </div>
    </div>
    <script>
        document.addEventListener('click', e => {
            const menu_btn = document.querySelector('#profile_menu_btn');
            const menu = document.querySelector('#profile_menu');
            if (!menu.contains(e.target) && e.target !== menu_btn) {
                menu.classList.remove("show")
            }
        })

        function toggle_dropdown_menu(button) {
            button.nextElementSibling.classList.toggle("show");
        }

        function toggle_profile_menu(name) {
            let profile_menu = document.getElementById(name)
            profile_menu.classList.toggle("show");
        }
    </script>
</body>

</html>
