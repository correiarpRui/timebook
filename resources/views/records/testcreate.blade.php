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
            <a href="{{ route('record.create') }}">Create record</a>
        </div>
        <form action="{{ route('record.store') }}" method="POST">
            @csrf
            <div class=" border rounded-md bg-white mt-6">
                <div class="border-b flex justify-between p-5 items-center">
                    <p class="font-semibold text-lg">Create new record</p>
                </div>
                <div class="py-2 flex flex-col gap-5">
                    <div class="px-5 flex items-center">
                        <label for="role_id" class="font-semibold mr-2 min-w-[150px] py-[6px] self-start">User name</label>
                        <div class="flex flex-col grow">
                            <div class="flex flex-col grow relative">
                                <button type="button"
                                    class="flex items-center justify-between bg-transparent text-[#6b6f80] border border-[#e2e4ef] rounded-md h-[42px] px-3 py-1 focus:outline-none focus:border-[#9aa0ac]"
                                    onclick="toggle_user_menu(this)">
                                    <span id="user_label">
                                        select user
                                    </span>
                                    <svg class="flex-shrink-0" xmlns="http://www.w3.org/2000/svg" width="16"
                                        height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                        stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                                        class="lucide lucide-chevron-down text-muted-foreground">
                                        <path d="m6 9 6 6 6-6"></path>
                                    </svg>
                                </button>
                                <div class="select_user_menu grid w-full absolute bg-white">
                                    <div class="overflow-hidden">
                                        @foreach ($users as $user)
                                            <div
                                                class="flex items-center px-3 rounded-md hover:bg-[#eff0f6] text-[#6b6f80]">
                                                <input type="radio" name="user_id" id="user{{ $user->id }}"
                                                    value="{{ $user->id }}" class="peer hidden">
                                                <label for="user{{ $user->id }}" class="grow cursor-pointer py-1"
                                                    onclick=get_user(this)>{{ $user->first_name }}
                                                    {{ $user->last_name }}</label>
                                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                                    viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                                    stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                                                    class="lucide lucide-check mr-2 opacity-100 m-auto  hidden peer-checked:block">
                                                    <path d="M20 6 9 17l-5-5"></path>
                                                </svg>
                                            </div>
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="px-5 flex items-center">
                        <label for="date" class="font-semibold mr-2 min-w-[150px] py-[6px] self-start">Date</label>
                        <div class="flex flex-col grow">
                            <input
                                class="bg-transparent text-[#6b6f80] border border-[#e2e4ef] rounded-md h-[42px] px-3 py-1 focus:outline-none focus:border-[#9aa0ac] w-full"
                                type="date" name="date" value="{{ old('date') }}">
                            @error('date')
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
                    <div class="px-5 flex items-center">
                        <label for="role_id" class="font-semibold mr-2 min-w-[150px] py-[6px] self-start">Schedule</label>
                        <div class="flex flex-col grow">
                            <div class="flex flex-col grow relative">
                                <button type="button"
                                    class="flex items-center justify-between bg-transparent text-[#6b6f80] border border-[#e2e4ef] rounded-md h-[42px] px-3 py-1 focus:outline-none focus:border-[#9aa0ac]"
                                    onclick="toggle_schedule_menu(this)">
                                    <span id="schedule_label">
                                        select schedule
                                    </span>
                                    <svg class="flex-shrink-0" xmlns="http://www.w3.org/2000/svg" width="16"
                                        height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                        stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                                        class="lucide lucide-chevron-down text-muted-foreground">
                                        <path d="m6 9 6 6 6-6"></path>
                                    </svg>
                                </button>
                                <div class="select_schedule_menu grid w-full absolute bg-white">
                                    <div class="overflow-hidden">
                                        @foreach ($schedules as $schedule)
                                            <div
                                                class="flex items-center px-3 rounded-md hover:bg-[#eff0f6] text-[#6b6f80]">
                                                <input type="radio" name="schedule_id"
                                                    id="schedule{{ $schedule->id }}" value="{{ $schedule->id }}"
                                                    class="peer hidden">
                                                <label for="schedule{{ $schedule->id }}" class="grow cursor-pointer py-1"
                                                    onclick="get_schedule(this)">{{ $schedule->name }}</label>
                                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                                    viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                                    stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                                                    class="lucide lucide-check mr-2 opacity-100 m-auto  hidden peer-checked:block">
                                                    <path d="M20 6 9 17l-5-5"></path>
                                                </svg>
                                            </div>
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="px-5 flex items-center">
                        <label for="morning_start" class="font-semibold mr-2 min-w-[150px] py-[6px] self-start">Morning
                            Start</label>
                        <div class="flex flex-col grow">
                            <input
                                class="bg-transparent text-[#6b6f80] border border-[#e2e4ef] rounded-md h-[42px] px-3 py-1 focus:outline-none focus:border-[#9aa0ac] w-full"
                                type="text" name="morning_start" id="morning_start" disabled>
                        </div>
                    </div>
                    <div class="px-5 flex items-center">
                        <label for="morning_end" class="font-semibold mr-2 min-w-[150px] py-[6px] self-start">Morning
                            End</label>
                        <div class="flex flex-col grow">
                            <input
                                class="bg-transparent text-[#6b6f80] border border-[#e2e4ef] rounded-md h-[42px] px-3 py-1 focus:outline-none focus:border-[#9aa0ac] w-full"
                                type="text" name="morning_end" id="morning_end" disabled>
                        </div>
                    </div>
                    <div class="px-5 flex items-center">
                        <label for="afternoon_start"
                            class="font-semibold mr-2 min-w-[150px] py-[6px] self-start">Afternoon
                            Start</label>
                        <div class="flex flex-col grow">
                            <input
                                class="bg-transparent text-[#6b6f80] border border-[#e2e4ef] rounded-md h-[42px] px-3 py-1 focus:outline-none focus:border-[#9aa0ac] w-full"
                                type="text" name="afternoon_start" id="afternoon_start" disabled>
                        </div>
                    </div>
                    <div class="px-5 flex items-center">
                        <label for="afternoon_end" class="font-semibold mr-2 min-w-[150px] py-[6px] self-start">Afternoon
                            End</label>
                        <div class="flex flex-col grow">
                            <input
                                class="bg-transparent text-[#6b6f80] border border-[#e2e4ef] rounded-md h-[42px] px-3 py-1 focus:outline-none focus:border-[#9aa0ac] w-full"
                                type="text" name="afternoon_end" id="afternoon_end" disabled>
                        </div>
                    </div>
                </div>
            </div>
            <div class="flex items-center mt-6">
                <button
                    class="hover:bg-[#ff7f31] bg-[#FF8B45] font-semibold rounded-md h-9 mx-5 mb-5 px-6 text-white tracking-wider">Create
                    record
                </button>
                <a href="{{ route('records') }}"
                    class="font-semibold border rounded-md h-9 mb-5 px-6 tracking-wider flex items-center bg-[#f4f5f7] border-[#CBCFD2] hover:bg-[#CBCFD2] hover:border-[#dae0e5]"><span>Cancel</span>
                </a>
            </div>
        </form>
    </div>
    <script>
        schedules = <?php echo json_encode($schedules); ?>;
        console.log(schedules)

        function toggle_user_menu(button) {
            button.nextElementSibling.classList.toggle("show");
        }

        function get_user(user) {
            user_label = document.getElementById("user_label")
            user_label.textContent = user.textContent
            user_label.click()
        }

        function toggle_schedule_menu(button) {
            button.nextElementSibling.classList.toggle("show");
        }

        function get_schedule(schedule) {
            schedule_label = document.getElementById("schedule_label")
            schedule_label.textContent = schedule.textContent
            schedule_label.click()

            const schedule_item = schedules.find((e) => e.name === schedule.textContent)

            console.log(schedule_item);

            morning_start = document.getElementById('morning_start')
            morning_start.value = schedule_item.morning_start

            morning_end = document.getElementById('morning_end')
            morning_end.value = schedule_item.morning_end

            afternoon_start = document.getElementById('afternoon_start')
            afternoon_start.value = schedule_item.afternoon_start

            afternoon_end = document.getElementById('afternoon_end')
            afternoon_end.value = schedule_item.afternoon_end
        }
    </script>
@endsection
