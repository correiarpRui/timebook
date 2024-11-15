<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <title>Document</title>
</head>

<body class="bg-gray-300">
    <div class="flex">
        <nav class="w-[250px] h-screen shadow-md shadow-black py-10">
            <div class="flex flex-col justify-between h-full">
                <ul class="px-6">
                    <li class="uppercase bg-orange-400 rounded-md px-8 py-1 my-5"><a
                            href="{{ route('dashboard.index') }}">Dashboard</a></li>
                    <li class="uppercase bg-orange-400 rounded-md px-8 py-1 my-5"><a
                            href="{{ route('records') }}">Records</a></li>
                    <li class="uppercase bg-orange-400 rounded-md px-8 py-1 my-5"><a
                            href="{{ route('schedule') }}">Schedule</a></li>
                    <li class="uppercase bg-orange-400 rounded-md px-8 py-1 my-5"><a
                            href="{{ route('users') }}">Users</a></li>
                </ul>

                <div class="select_menu px-6">
                    <ul class="options bg-[#262626] p-3 rounded-lg hidden">
                        <li class="option text-white hover:bg-[#3c3c3c] rounded-md px-8 py-2 mt-5 mb-2"><a
                                href="{{ route('profile.show', auth()->user()->id) }}">Profile</a></li>
                        <li class="option text-white hover:bg-[#3c3c3c] rounded-md px-8 py-2 mt-2 mb-5"><a
                                href="{{ route('logout') }}">Logout</a></li>
                    </ul>

                    <div class="select_button uppercase bg-orange-400 rounded-md px-8 py-1 my-5">
                        More</div>

                </div>
            </div>
        </nav>

        @yield('content')

    </div>

</body>

</html>

<script>
    const select_menu = document.querySelector(".select_menu"),
        select_button = select_menu.querySelector(".select_button"),
        options = select_menu.querySelector(".options");

    select_button.addEventListener("click", () => select_menu.classList.toggle("active"));
</script>

<style>
    .select_menu.active .options {
        display: block;
    }
</style>


{{-- Hover #3c3c3c  --}}
{{-- Menu #262626 --}}
{{-- Background black --}}
