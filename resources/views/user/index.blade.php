@extends('layouts.layout')

@section('content')
    <div class="p-6 border border-[#27272a] rounded-md m-6">
        <div class="text-2xl font-bold tracking-tight text-[#fafafa]">
            Users
        </div>
        <div class="px-10 pt-10 pb-5">
            <a class="uppercase bg-orange-400 rounded-md px-8 py-1 my-5" href="/user/create">New User</a>
        </div>

        <div class="px-10 py-2">
            <table class="border-collapse w-full [&>tbody>*:nth-child(odd)]:bg-white">
                <tr>
                    <th class="border border-gray-400 text-left p-2">Name</th>
                    <th class="border border-gray-400 text-left p-2">Email</th>
                    <th class="border border-gray-400 text-left p-2">Date of birth</th>
                    <th class="border border-gray-400 text-left p-2">Role</th>
                    <th class="border border-gray-400 text-left p-2">Schedule</th>
                    <th class="border border-gray-400 text-left p-2">Actions</th>
                </tr>
                @foreach ($users as $user)
                    <tr>
                        <td class="border border-gray-400 text-left p-2">{{ $user->name }}</td>
                        <td class="border border-gray-400 text-left p-2">{{ $user->email }}</td>
                        <td class="border border-gray-400 text-left p-2">{{ $user->birth_date }}</td>
                        <td class="border border-gray-400 text-left p-2">{{ $user->role->role }}</td>
                        <td class="border border-gray-400 text-left p-2">
                            {{ $user->schedule ? $user->schedule->name : 'No Schedule' }}</td>
                        <td class="border border-gray-400 text-left p-2">
                            <div class="flex gap-2">
                                <a href="{{ route('user.update', $user->id) }}">Update</a>
                                <form action="{{ route('user.destroy', $user->id) }}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <button>Delete</button>
                                </form>
                            </div>
                        </td>
                    </tr>
                @endforeach
            </table>
        </div>
    </div>
@endsection
