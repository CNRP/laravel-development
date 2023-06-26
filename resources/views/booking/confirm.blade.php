<!-- resources/views/booking/confirm.blade.php -->

<x-app-layout>
    <div class="h-[80vh] flex items-center">
        <div class="max-w-md mx-auto bg-white p-8 border border-gray-300 shadow-sm">
            <h3 class="text-lg font-semibold mb-4">Confirm User Deletion</h3>
            <p class="text-gray-600 mb-6">Are you sure you want to delete this user?</p>
            <p class="bg-red-200 px-4 py-2 rounded mb-4"><strong>Name:</strong> {{ $user->name }}</p>
            <p class="bg-red-200 px-4 py-2 rounded mb-8"><strong>Email:</strong> {{ $user->email }}</p>
            <form action="{{ route('users.delete', $user->id) }}" method="POST">
                @csrf
                @method('DELETE')
                <button type="submit" class="bg-red-500 text-white px-4 py-2 mb-8 rounded hover:bg-red-600">Delete</button>
            </form>
            <a href="{{ route('users.cancel') }}" class="text-blue-500 hover:underline">Cancel</a>
        </div>
    </div>
</x-app-layout>
