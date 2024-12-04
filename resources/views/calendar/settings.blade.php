@extends('layouts.layout')

@section('content')
    <div class="text-[#fafafa] p-6">

        <div class="flex justify-between">
            <div class="text-2xl font-bold tracking-tight text-[#fafafa]">Calendar settings</div>
        </div>
        <hr class="my-[24px] border-[#27272a]">

        <form action="" class="flex gap-4">
            @csrf
            <input
                class="bg-transparent border border-[#27272a] rounded-md h-9 px-4 py-1 focus:outline-none focus:border-[#e5e7eb]"
                type="number" name="birth_date" value="number_insert" placeholder="day">
            <input
                class="bg-transparent border border-[#27272a] rounded-md h-9 px-4 py-1 focus:outline-none focus:border-[#e5e7eb]"
                type="text" name="birth_date" value="" placeholder="name">
            <button class="bg-[#fafafa] text-[#09090b] font-medium rounded-md h-9 px-4 text-sm">Add
                holiday</button>
        </form>
        <div class="flex flex-col gap-2">
            @foreach ($months as $key => $month)
                <div>
                    <div class="font-medium pt-4 pb-2 px-2">{{ $month }}</div>
                    @foreach ($holidays[$key] as $day => $name)
                        <div class="flex gap-2 border border-[#27272a] rounded-lg py-2 px-4 mb-2">
                            <div>{{ $day }}</div>
                            <div>{{ $name }}</div>
                        </div>
                    @endforeach

                </div>
            @endforeach
        </div>
    </div>
    <script>
        function get_year(value) {
            button_year_label = document.getElementById("button_year_label")
            button_year_label.textContent = value.textContent
            button_year_label.click()
            console.log(value.textContent)
        }
    </script>
@endsection
