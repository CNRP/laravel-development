
<h2 class="text-2xl font-semibold mb-4">Your Booking</h2>
<div>
        <table class="divide-y divide-gray-200 mb-8">
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
            @foreach ($booking as $item)
                <tr>
                    <td class="px-6 py-4 whitespace-nowrap">
                        {{ optional($item['service'])->name }}
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap">
                        <div class="truncate w-[200px]">{{ optional($item['service'])->description }}</div>
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap">
                        ${{ optional($item['service'])->price  }}
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap">
                        {{ optional($item['service'])->duration  }} minutes
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap">
                        {{ optional($item['service'])->category }}
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap">
                        <form action="{{ route('services.remove', ['id' => optional($item['service'])->id ]) }}" method="POST">
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

