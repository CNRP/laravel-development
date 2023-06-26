
@if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

@if(session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
@endif



@if(isset($step))
    @if($step == 1)
        <livewire:services-table />
    @elseif($step == 2)
        <h2 class="text-2xl font-semibold mb-4">Select a date</h2>
        <livewire:weeks />

    @elseif($step == 3)
        <livewire:select-time :results="$results" />

    @elseif($step == 4)
<form action="{{ route('booking.submit-appointment') }}" method="POST" class="w-full mx-auto mt-6">
    @csrf
    <input type="hidden" name="booking_date" value="{{ session('booking-date') }}">
    <input type="hidden" name="booking_time" value="{{ session('booking-time') }}">
    <h2 class="text-2xl font-semibold mb-4">Booking for</h2>

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
        <tr>
            <td class="px-6 py-4 whitespace-nowrap">
                {{ session('booking-time') }}
            </td>
            <td class="px-6 py-4 whitespace-nowrap">
                <a class="block px-4 py-2 text-xl text-white bg-blue-500 rounded hover:bg-blue-600" href="{{ route('booking.step', ['step' => 2]) }}">
                    Change Time
                </a>
            </td>
        </tr>
        </tbody>
    </table>

    <div class="mb-4">
        <label for="client_name" class="block mb-2">Client Name:</label>
        <input type="text" name="client_name" required class="w-full p-2 border border-gray-300 rounded" value="{{ auth()->user()->name }}">
    </div>

    <div class="mb-4">
        <label for="client_email" class="block mb-2">Client Email:</label>
        <input type="email" name="client_email" required class="w-full p-2 border border-gray-300 rounded" value="{{ auth()->user()->email }}">
    </div>

        <div class="mb-4">
            <label for="comments" class="block mb-2">Comments:</label>
            <textarea name="comments" class="w-full p-2 border border-gray-300 rounded"></textarea>
        </div>

        <div class="text-center">
            <button type="submit" class="px-4 py-2 bg-blue-500 text-white rounded hover:bg-blue-600">Create Appointment</button>
        </div>
    @endif
</form>
<script>
    function toggleSlots(select) {
        const slotDivs = document.querySelectorAll('.slot-div');
        const selectedLabel = select.value;

        slotDivs.forEach((div) => {
            if (div.getAttribute('data-label') === selectedLabel) {
                div.classList.remove('hidden');
            } else {
                div.classList.add('hidden');
            }
        });
    }
</script>

@endif
