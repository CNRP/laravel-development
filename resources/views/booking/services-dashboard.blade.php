<?php
use App\Models\Service;
$services = App\Models\Service::all();

?>
<x-app-layout>


    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Services') }}
        </h2>
    </x-slot>

    <div class="py-6">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                <div class="p-6 sm:px-10 bg-white border-b border-gray-200 ">

                    <!-- Display success message if any -->
                    @if (session('success'))
                        <div class="bg-green-200 text-green-800 p-4 rounded mb-4">
                            {{ session('success') }}
                        </div>
                    @endif

                    <div class="overflow-x-auto lg:overflow-hidden mb-6">
                    <!-- Services table -->
                    <table class="min-w-full divide-y divide-gray-200">
                        <thead class="bg-gray-50">
                        <tr>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Name
                            </th>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Description
                            </th>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Price
                            </th>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Duration
                            </th>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Category
                            </th>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Actions
                            </th>
                        </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                        @foreach ($services as $service)
                            <tr>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    {{ $service->name }}
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="truncate  w-[200px]">{{ $service->description }}</div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    ${{ $service->price }}
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    {{ $service->duration }} minutes
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    {{ $service->category }}
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <form action="{{ route('services.destroy', $service->id) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this service?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="text-red-600 hover:text-red-900">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                                            </svg>
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                    </div>

                    <!-- Button to toggle the form -->
                    <button id="createServiceButton" class="bg-blue-500 text-white py-2 px-4 rounded mb-4">
                        Create New Service
                    </button>
                </div>
            </div>
        </div>
    </div>

    <!-- Pop-out form -->
    <div id="createServiceForm" class="hidden fixed top-0 left-0 w-full h-full flex items-center justify-center bg-gray-900 bg-opacity-75">
        <div class="bg-white rounded shadow p-6 min-800">
            <h2 class="text-lg font-semibold mb-4">Create New Service</h2>
            <form action="{{ route('services.index') }}" method="POST">
                @csrf
                <!-- Form fields for creating a new service -->
                <div class="mb-4">
                    <label for="name" class="block mb-2">Name:</label>
                    <input type="text" name="name" id="name" class="w-full p-2 border border-gray-300 rounded">
                </div>
                <div class="mb-4">
                    <label for="description" class="block mb-2">Description:</label>
                    <textarea name="description" id="description" class="w-full p-2 border border-gray-300 rounded"></textarea>
                </div>
                <div class="mb-4">
                    <label for="price" class="block mb-2">Price:</label>
                    <input type="number" name="price" id="price" step="0.01" class="w-full p-2 border border-gray-300 rounded">
                </div>
                <div class="mb-4">
                    <label for="duration" class="block mb-2">Duration (minutes):</label>
                    <input type="number" name="duration" id="duration" class="w-full p-2 border border-gray-300 rounded">
                </div>
                <div class="mb-4">
                    <label for="category" class="block mb-2">Category:</label>
                    <input type="text" name="category" id="category" class="w-full p-2 border border-gray-300 rounded">
                </div>
                <div class="text-center">
                    <button type="submit" class="bg-blue-500 text-white py-2 px-4 rounded hover:bg-blue-600">Create Service</button>
                </div>
            </form>
        </div>
    </div>

    <script>
        document.getElementById('createServiceButton').addEventListener('click', function() {
            document.getElementById('createServiceForm').classList.remove('hidden');
        });

        document.getElementById('createServiceForm').addEventListener('click', function(event) {
            if (event.target === this) {
                this.classList.add('hidden');
            }
        });
    </script>
</x-app-layout>
