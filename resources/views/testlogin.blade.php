<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <title>Document</title>
</head>

<body class="min-h-screen flex items-center justify-center bg-[#edeef5]">
    <div
        class="mx-auto min-w-[320px] min-h-[390px] bg-white flex flex-col items-center justify-center p-5 text-[#454e60] rounded-sm">
        <div class="mb-3">
            <span class="font-semibold text-3xl">Logo</span>
        </div>
        <div class="mb-3">
            <span class=" text-2xl">Login</span>
        </div>
        <div class="mb-3">
            <span class="text-sm text-[#8f949f]">Sign In to your account</span>
        </div>
        <div class="mb-3">
            <form action="{{ route('authenticate') }}" method="POST">
                @csrf
                <div class="mb-3">
                    <div class="flex">
                        <span class=" px-2 py-2 border border-[#eff0f6]">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24">
                                <path fill="#454e60" fill-rule="evenodd"
                                    d="M12 4a4 4 0 1 0 0 8a4 4 0 0 0 0-8m-2 9a4 4 0 0 0-4 4v1a2 2 0 0 0 2 2h8a2 2 0 0 0 2-2v-1a4 4 0 0 0-4-4z"
                                    clip-rule="evenodd" />
                            </svg>
                        </span>
                        <input type="text" name="email" id="email"
                            class="border border-[#eff0f6] focus:outline-none px-3 py-2 focus:border-[#9aa0ac]"
                            placeholder="Email">
                    </div>
                    @error('email')
                        <div class="flex h-[24px] text-[#dc3838] items-center justify-start text-sm gap-1 py-2 pl-2 mt-3">
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
                <div class="mb-4">
                    <div class="flex">
                        <span class="px-2 py-2 border border-[#eff0f6]"><svg xmlns="http://www.w3.org/2000/svg"
                                width="24"height="24" viewBox="0 0 24 24">
                                <path fill="#454e60" fill-rule="evenodd"
                                    d="M8 10V7a4 4 0 1 1 8 0v3h1a2 2 0 0 1 2 2v7a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2v-7a2 2 0 0 1 2-2zm2-3a2 2 0 1 1 4 0v3h-4zm2 6a1 1 0 0 1 1 1v3a1 1 0 1 1-2 0v-3a1 1 0 0 1 1-1"
                                    clip-rule="evenodd" />
                            </svg>
                        </span>
                        <input type="password" name="password" id="password"
                            class="border border-[#eff0f6] focus:outline-none px-3 py-2 focus:border-[#9aa0ac]"
                            placeholder="Password">
                    </div>
                    @error('password')
                        <div class="flex h-[24px] text-[#dc3838] items-center justify-start text-sm gap-1 py-2 pl-2 mt-3">
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
                <button class="bg-[#ff7f31] font-semibold rounded-md h-9 text-white text-sm w-full ">Login</button>
            </form>
        </div>
        <div class="text-sm text-[#ff7f31] tracking-wide">
            Forgot password?
        </div>
    </div>
</body>

</html>
