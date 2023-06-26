<?php
use App\Models\User;
$users = User::all();

?>
<x-app-layout>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            <div class="p-4 sm:p-8 bg-white bg-gray-800 shadow sm:rounded-lg">

                <h1 class="text-2xl font-bold mb-4">List of Users</h1>

                @if (auth()->user()->role->name === 'client')
                    <!-- Content only visible to users with the "client" role --><p>YO client</p>
                @endif

                @if (auth()->user()->role->name === 'staff')
                    <!-- Content only visible to users with the "staff" role -->
                    <p class="pb-4">You are logged in as {{ auth()->user()->name }} (<strong>Staff</strong>)</p>
                @endif

                <div class="overflow-x-auto">
                    <table class="min-w-full bg-white border border-gray-300">
                        <thead>
                        <tr>
                            <th class="py-2 px-4 bg-gray-200 font-semibold text-left">Name</th>
                            <th class="py-2 px-4 bg-gray-200 font-semibold text-left">Email</th>
                            <th class="py-2 px-4 bg-gray-200 font-semibold text-center">Role</th>
                            <th class="py-2 px-4 bg-gray-200 font-semibold text-center">tools</th>
                            <!-- Add more table headers if needed -->
                        </tr>
                        </thead>
                        <tbody>
                        @foreach ($users as $user)
                            <tr>
                                <td class="py-2 px-4 border-t">{{ $user->name }}</td>
                                <td class="py-2 px-4 border-t">{{ $user->email }}</td>
                                <td class="py-2 px-4 border-t text-center">
                                    @if ($user->role->name === 'staff')
                                        <strong class="bg-gray-100 px-4 py-2">{{ $user->role->name }}</strong>
                                    @else
                                        {{ $user->role->name }}
                                    @endif
                                </td>
                                <td class="py-2 px-4 border-t flex items-center justify-center">
                                    @if ($user->role->name === 'client')
                                    <form action="{{ route('users.remove', $user) }}" method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="bg-red-500 text-white px-4 py-2 rounded hover:bg-red-600">
                                            <i class="fas fa-trash mr-2"></i> Delete
                                        </button>
                                    </form>
                                    @else
                                        <p class="px-4 py-2">N/A</p>
                                    @endif
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>

            </div>
        </div>
    </div>
</x-app-layout>
