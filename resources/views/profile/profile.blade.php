@extends('layouts.testlayout')

@section('content')
    <div class="px-6">
        <div class="py-6">Profile</div>
        {{-- rows --}}
        <div class="py-6 border rounded-md">
            This is test {{ Auth::user()->role_id }}
        </div>
    </div>
@endsection
