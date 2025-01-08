@extends('layouts.testlayout')

@section('content')
    <div class="px-6">
        <div class="py-6">Profile</div>
        {{-- rows --}}
        <div class=" border rounded-md bg-white mb-6">
            <div class="border-b">
                <p class="p-5 font-semibold text-lg">User information</p>
            </div>
            <form action="">
                <div class="px-5 pt-5 pb-2 flex items-center">
                    <label for="first_name" class="font-semibold mr-2 min-w-[150px]">First name</label>
                    <input
                        class="bg-transparent text-[#6b6f80] border border-[#e2e4ef] rounded-md h-9 px-3 py-1 focus:outline-none focus:border-[#9aa0ac] w-full"
                        type="text" name="first_name" value="">
                </div>
                <div class="px-5 py-2 flex items-center">
                    <label for="last_name" class="font-semibold mr-2 min-w-[150px]">Last name</label>
                    <input
                        class="bg-transparent text-[#6b6f80] border border-[#e2e4ef] rounded-md h-9 px-3 py-1 focus:outline-none focus:border-[#9aa0ac] w-full"
                        type="text" name="last_name" value="">
                </div>
                <div class="px-5 py-2 flex items-center">
                    <label for="email" class="font-semibold mr-2 min-w-[150px]">Email</label>
                    <input
                        class="bg-transparent text-[#6b6f80] border border-[#e2e4ef] rounded-md h-9 px-3 py-1 focus:outline-none focus:border-[#9aa0ac] w-full"
                        type="email" name="email" value="">
                </div>
                <div class="px-5 py-2 flex items-center">
                    <label for="birth_date" class="font-semibold mr-2 min-w-[150px]">Date of birth</label>
                    <input
                        class="bg-transparent text-[#6b6f80] border border-[#e2e4ef] rounded-md h-9 px-3 py-1 focus:outline-none focus:border-[#9aa0ac] w-full"
                        type="date" name="birth_date" value="">
                </div>
                <button
                    class="bg-[#ff7f31] font-semibold rounded-md h-9 mx-5 mt-3 mb-5 px-6 text-white tracking-wider">Update
                    profile
                </button>
            </form>
        </div>
        <div class=" border rounded-md bg-white">
            <div class="border-b">
                <p class="p-5 font-semibold text-lg">Security</p>
            </div>
            <div>
                <form action="">
                    <div class="px-5 pt-5 pb-2 flex items-center">
                        <label for="first_name" class="font-semibold mr-2 min-w-[150px]">Current password</label>
                        <input
                            class="bg-transparent text-[#6b6f80] border border-[#e2e4ef] rounded-md h-9 px-3 py-1 focus:outline-none focus:border-[#9aa0ac] w-full"
                            type="text" name="first_name" value="">
                    </div>
                    <div class="px-5 py-2 flex items-center">
                        <label for="last_name" class="font-semibold mr-2 min-w-[150px]">New password</label>
                        <input
                            class="bg-transparent text-[#6b6f80] border border-[#e2e4ef] rounded-md h-9 px-3 py-1 focus:outline-none focus:border-[#9aa0ac] w-full"
                            type="text" name="last_name" value="">
                    </div>
                    <button
                        class="bg-[#ff7f31] font-semibold rounded-md h-9 mx-5 mt-3 mb-5 px-6 text-white tracking-wider">Update
                        password
                    </button>
                </form>
            </div>
        </div>
    </div>
@endsection
