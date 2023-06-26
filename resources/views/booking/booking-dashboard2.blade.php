<x-app-layout>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            <div class="p-4 sm:p-8 bg-white bg-gray-800 shadow sm:rounded-lg">
                <script>
                    document.addEventListener('DOMContentLoaded', function () {
                        var calendarEl = document.getElementById('calendar');
                        var calendar = new FullCalendar.Calendar(calendarEl, {
                            initialView: 'timeGridWeek',
                            slotMinTime: '7:00:00',
                            slotMaxTime: '22:00:00',
                            events: @json($events),
                            nowIndicator: true,
                        });
                        calendar.render();
                    });
                </script>

                <div id='calendar'></div>
                <div class="mt-6">
                    <h2 class="text-2xl font-semibold mb-4">Appointments</h2>
                    @if ($appointments->count() > 0)
                        <table class="w-full border-collapse border">
                            <thead>
                            <tr>
                                <th class="border px-4 py-2">Start Time</th>
                                <th class="border px-4 py-2">Finish Time</th>
                                <th class="border px-4 py-2">Duration</th>
                                <th class="border px-4 py-2">Client Name</th>
                                <th class="border px-4 py-2">Employee Name</th>
                                <th class="border px-4 py-2">Actions</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach (\App\Models\Booking::all()->sortBy('start_time') as $appointment)
                                @php
                                    $startTime = \Carbon\Carbon::parse($appointment->start_time);
                                    $finishTime = \Carbon\Carbon::parse($appointment->finish_time);
                                    $duration = $finishTime->diffInMinutes($startTime);
                                @endphp
                                <tr>
                                    <td class="border px-4 py-2">{{ $startTime->format('H:i:s') }}</td>
                                    <td class="border px-4 py-2">{{ $finishTime->format('H:i:s') }}</td>
                                    <td class="border px-4 py-2">{{ $duration }} minutes</td>
                                    <td class="border px-4 py-2">{{ $appointment->client->name }}</td>
                                    <td class="border px-4 py-2">{{ $appointment->employee->name }}</td>
                                    <td class="border px-4 py-2">
                                        <form action="{{ route('booking.destroy', $appointment->id) }}" method="POST"
                                              onsubmit="return confirm('Are you sure you want to delete this appointment?')">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="text-red-500">Delete</button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    @else
                        <p class="bg-white px-4 py-2 rounded shadow">No appointments found.</p>
                    @endif
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
