<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <title>Document</title>
</head>

<body class="h-screen bg-slate-500 flex justify-center items-center">
    <div class="bg-white p-10 rounded-md">
        <div class="text-3xl text-center mb-5">
            Login
        </div>
        <form action="{{ route('auth.authenticate') }}" class="flex flex-col" method="POST">
            @csrf
            <div class="flex flex-col mb-3 gap-1">
                <input type="text" class="border border-slate-300 rounded-md p-2" placeholder="Email" name="email"
                    id="email">
            </div>
            @error('email')
                <div class="text-red-600">{{ $message }}</div>
            @enderror
            <div class="flex flex-col mb-3 gap-1">
                <input type="password" class="border border-slate-300 rounded-md p-2" placeholder="Password"
                    name="password" id="password">
            </div>
            @error('password')
                <div class="text-red-600">{{ $message }}</div>
            @enderror
            <button class="bg-slate-300 p-2 rounded-md">Login</button>
        </form>
    </div>
</body>

</html>
