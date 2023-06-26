<div>
    {{-- Knowing others is intelligence; knowing yourself is true wisdom. --}}

    @foreach ($categories as $category)
        <h3 class="text-lg font-semibold mb-4">{{ $category }}</h3>

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
                        Actions
                    </th>
                </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                @foreach ($services->where('category', $category) as $service)
                    <tr>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <div class="truncate"style="width: 100px;"> {{ $service->name }}</div>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap" >
                            <div class="truncate"style="width: 100px;">{{ $service->description }}</div>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            ${{ $service->price }}
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            {{ $service->duration }} minutes
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <form action="{{ route('services.add', ['service' => $service->id]) }}" method="POST">
                                @csrf
                                <input type="hidden" name="id" value="{{ $service->id }}">
                                <button type="submit" class="text-green-600 hover:text-green-900">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                                    </svg>
                                </button>
                            </form>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    @endforeach
    <form action="{{ route('booking.step', ['step' => 2]) }}" method="get">
        <button type="submit" class="bg-green-500 hover:bg-green-600 text-white font-bold py-2 px-4 rounded">
            Confirm Appointment
        </button>
    </form>
</div>
