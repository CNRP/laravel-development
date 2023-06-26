<div>
    <table class="min-w-full divide-y divide-gray-200 mb-8">
        <thead class="bg-gray-50">
        <tr>
            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                Booking For
            </th>
            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                Change
            </th>
        </tr>
        </thead>
        <tbody class="bg-white divide-y divide-gray-200">
        <tr>
            <td class="px-6 py-4 whitespace-nowrap">
                {{ \Carbon\Carbon::parse(session('booking-date'))->isoFormat('dddd Do MMMM YYYY') }}
            </td>
            <td class="px-6 py-4 whitespace-nowrap">
                <a class="block px-4 py-2 text-xl text-white bg-blue-500 rounded hover:bg-blue-600" href="{{ route('booking.step', ['step' => 1]) }}">
                    Change Date
                </a>
            </td>
        </tr>
        </tbody>
    </table>

    <!-- Display the booking details here -->
    <div class="dropdown">
        <h2 class="text-2xl font-semibold mb-4">Please select a time</h2>
        <select id="slot-dropdown" class="text-lg" onchange="toggleSlots(this)">
            <option value="">-- View Appointments --</option>
            @foreach ($results as $result)
                @php
                    $slotSummary = '';
                    if (count($result['slots']) > 0) {
                        foreach($result['slots'] as $slotResult){
                            preg_match('/(\d+)(?::\d+)?(am|pm)/i', $slotResult, $addToSummary);
                            $slotSummary .= $addToSummary[0] . ", ";
                        }

                    } else {
                        $slotSummary = 'No slots available';
                    }
                @endphp
                <option value="{{ $result['label'] }}">{{ $slotSummary }}</option>
            @endforeach
        </select>
    </div>

    <div class="w-full mx-auto mt-6">
        @foreach ($results as $result)
            <div class="slot-div hidden" data-label="{{ $result['label'] }}">
                @if (count($result['slots']) > 0)
                    <div class="flex flex-wrap gap-x-4">
                        @foreach ($result['slots'] as $slot)
                            @php
                                $formattedSlot = str_replace('>', '<i class="fa px-2 fa-arrow-right" aria-hidden="true"></i>', $slot);
                            @endphp
                            <button type="button" class="my-2 flex items-center px-4 py-2 bg-green-700 text-white rounded" wire:click.prevent="handleSlotSelection('{{ $slot }}')">
                                {!! $formattedSlot !!}
                            </button>
                        @endforeach
                    </div>
                @else
                    <p class="my-5">No slots available at this time.</p>
                @endif
            </div>
        @endforeach
    </div>
</div>
