<x-app-layout>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            <div class="p-4 sm:p-8 bg-white bg-gray-800 gap-8 flex flex-col lg:flex-row shadow sm:rounded-lg">
                <script>
                    document.addEventListener('DOMContentLoaded', function() {
                        var calendarEl = document.getElementById('calendar');

                        var calendar = new FullCalendar.Calendar(calendarEl, {
                            timeZone: 'Europe/London',
                            slotMinTime: '7:00:00',
                            slotMaxTime: '22:00:00',
                            initialView: 'timeGridFourDay',
                            headerToolbar: {
                                left: 'prev,next',
                                center: 'title',
                                right: 'timeGridDay,timeGridFourDay'
                            },
                            views: {
                                timeGridFourDay: {
                                    type: 'timeGrid',
                                    duration: { days: 4 },
                                    buttonText: '4 day'
                                }
                            },
                            events: @json($events)
                        });

                        calendar.render();

                        var calendarEl2 = document.getElementById('calendar2');

                        var calendar2 = new FullCalendar.Calendar(calendarEl2, {
                            timeZone: 'Europe/London',
                            initialView: 'listWeek',
                            events: @json($events)
                        });

                        calendar2.render();
                    });
                </script>

{{--                @php dd($events2);--}}
{{--             @endphp--}}

                <div class="w-full" id='calendar'></div><div class="w-full" id='calendar2'></div>

{{--                <div class="w-full ">--}}

{{--                    <h2 class="text-2xl font-semibold mb-4">Upcoming Schedule<span class=" ml-4 text-lg">(Connor Price)</span></h2>--}}
{{--                    @if ($appointments->count() > 0)--}}
{{--                        <table class="w-full border-collapse overflow-scroll">--}}
{{--                            <thead>--}}
{{--                            <tr>--}}
{{--                                <th class="border px-4 py-2">Time</th>--}}
{{--                                <th class="border px-4 py-2">Client Name</th>--}}
{{--                                <th class="border px-4 py-2">Actions</th>--}}
{{--                            </tr>--}}
{{--                            </thead>--}}
{{--                            <tbody>--}}
{{--                            @foreach ($appointments as $appointment)--}}
{{--                                @php--}}
{{--                                    $startTime = \Carbon\Carbon::parse($appointment->start_time);--}}
{{--                                    $finishTime = \Carbon\Carbon::parse($appointment->finish_time);--}}
{{--                                    $duration = $finishTime->diffInMinutes($startTime);--}}
{{--                                @endphp--}}
{{--                                <tr>--}}
{{--                                    <td class="border px-4 py-2">{{ $startTime->format('H:i') }} > {{ $finishTime->format('H:i') }} <br>({{ $duration }} minutes)</td>--}}
{{--                                    <td class="border px-4 py-2">{{ $appointment->client->name }}</td>--}}
{{--                                    <td class="border px-4 py-2">--}}
{{--                                        <div class="flex justify-center gap-4">--}}
{{--                                            <form action="{{ route('booking.destroy', $appointment->id) }}" method="POST"--}}
{{--                                                  onsubmit="return confirm('Are you sure you want to delete this appointment?')">--}}
{{--                                                @csrf--}}
{{--                                                @method('DELETE')--}}
{{--                                                <button type="submit" class="bg-blue-500 py-1 px-2 text-white">--}}
{{--                                                    <i class="fas fa-external-link-alt"></i>--}}
{{--                                                </button>--}}
{{--                                            </form>--}}
{{--                                            <form action="{{ route('booking.destroy', $appointment->id) }}" method="POST"--}}
{{--                                                  onsubmit="return confirm('Are you sure you want to delete this appointment?')">--}}
{{--                                                @csrf--}}
{{--                                                @method('DELETE')--}}
{{--                                                <button type="submit" class="bg-red-500 py-1 px-2 text-white">--}}
{{--                                                    <i class="fas fa-trash"></i>--}}
{{--                                                </button>--}}
{{--                                            </form>--}}
{{--                                        </div>--}}
{{--                                    </td>--}}
{{--                                </tr>--}}
{{--                            @endforeach--}}
{{--                            </tbody>--}}
{{--                        </table>--}}
{{--                    @else--}}
{{--                        <p class="bg-white px-4 py-2 rounded shadow">No appointments found.</p>--}}
{{--                    @endif--}}
{{--                </div>--}}

            </div>
        </div>
    </div>
</x-app-layout>
