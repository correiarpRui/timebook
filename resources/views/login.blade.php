<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <title>Document</title>
</head>

{{-- class=" flex h-screen w-[250px] box-border py-[5px] px-4 bg-[#09090b] border-r border-r-[#27272a] text-[#fafafa] sticky top-0 self-start"> --}}

<body class="font-roboto min-h-screen flex justify-center items-center login text-[#fafafa]">

    <div class="bg-[#09090b] border border-[#27272a] p-10 rounded-md w-[350px]">

        <form action="{{ route('authenticate') }}" class="flex flex-col" method="POST">
            @csrf
            <input type="text" class="border border-[#27272a] rounded-md p-2 text-sm bg-[#09090b] focus:outline-none"
                placeholder="name@exemple.com" name="email" id="email">
            @error('email')
                <div class="flex h-[24px] text-[#dc3838] items-center justify-start text-sm gap-1 py-2 pl-2">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14"
                        class=" flex-shrink-0 w-[16px] h-[16px]">
                        <path fill="#dc3838" fill-rule="evenodd"
                            d="M13.4 7A6.4 6.4 0 1 1 .6 7a6.4 6.4 0 0 1 12.8 0Zm-5.6 3.2a.8.8 0 1 1-1.6 0 .8.8 0 0 1 1.6 0ZM7 3a.8.8 0 0 0-.8.8V7a.8.8 0 0 0 1.6 0V3.8A.8.8 0 0 0 7 3Z"
                            clip-rule="evenodd"></path>
                    </svg>
                    <span>{{ $message }}</span>
                </div>
            @enderror
            <input type="password"
                class="border border-[#27272a] rounded-md p-2 mt-3 text-sm bg-[#09090b] focus:outline-none"
                placeholder="password" name="password" id="password">
            @error('password')
                <div class="flex h-[24px] text-[#dc3838] items-center justify-start text-sm gap-1 py-2 pl-2">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14"
                        class=" flex-shrink-0 w-[16px] h-[16px]">
                        <path fill="#dc3838" fill-rule="evenodd"
                            d="M13.4 7A6.4 6.4 0 1 1 .6 7a6.4 6.4 0 0 1 12.8 0Zm-5.6 3.2a.8.8 0 1 1-1.6 0 .8.8 0 0 1 1.6 0ZM7 3a.8.8 0 0 0-.8.8V7a.8.8 0 0 0 1.6 0V3.8A.8.8 0 0 0 7 3Z"
                            clip-rule="evenodd"></path>
                    </svg>
                    <span>{{ $message }}</span>
                </div>
            @enderror
            <button class="bg-[#fafafa] text-[#09090b] p-2 rounded-md text-sm font-medium mt-3">Login</button>
        </form>
    </div>
</body>

</html>
