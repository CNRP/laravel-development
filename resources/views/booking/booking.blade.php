<?php
use App\Models\Service;
$services = App\Models\Service::all();

?>
<x-guest-layout>

    <div class="text-center steps text-gray-700 mx-8 my-6 flex justify-between">
        <div class="flex flex-col items-center {{ $step === "1" ? 'text-white' : '' }}">
            <p class="w-12 h-12 rounded-full bg-gray-800 flex items-center justify-center text-lg">1</p>
            <p class="mt-2">Select Services</p>
        </div>
        <div class="flex flex-col items-center {{ $step === "2" ? 'text-white' : '' }}">
            <p class="w-12 h-12 rounded-full bg-gray-800 flex items-center justify-center text-lg">2</p>
            <p class="mt-2">Select Date</p>
        </div>
        <div class="flex flex-col items-center {{ $step === "3" ? 'text-white' : '' }}">
            <p class="w-12 h-12 rounded-full bg-gray-800 flex items-center justify-center text-lg">3</p>
            <p class="mt-2">Select Time</p>
        </div>
        <div class="flex flex-col items-center {{ $step === "4" ? 'text-white' : '' }}">
            <p class="w-12 h-12 rounded-full bg-gray-800 flex items-center justify-center text-lg">4</p>
            <p class="mt-2">Comfirm & Reserve</p>
        </div>
    </div>
    <div class="py-6">
        <div class="max-w-7xl flex mx-auto gap-8 sm:px-6 lg:px-8">
            <div class="bg-white w-3/5 px-8 py-8 overflow-hidden shadow-xl sm:rounded-lg">

{{--                @include('booking.partials.booking-items')--}}

                @include('booking.partials.booking-form')

            </div>

            <div class="bg-blue-700 text-white w-2/5 px-8 py-8 overflow-hidden h-fit shadow-xl sm:rounded-lg">
                <table class="table-auto divide-y divide-blue-500 w-full text-left border-gray-700">
                    <thead>
                        <tr class="">
                            <th class="px-4 text-lg py-2 ">Service</th>
                            <th class="px-4 text-lg py-2">Price</th>
                            <th class="px-4 text-lg py-2">Duration</th>
                            <th class="px-4 text-lg py-2">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                    @foreach ($booking as $item)
                        <tr>
                            <td class="px-4 py-2 w-24 truncate" style="max-width: 150px;">{{ optional($item['service'])->name }}</td>
                            <td class="px-4 py-2 whitespace-nowrap">£{{ optional($item['service'])->price }}</td>
                            <td class="px-4 py-2 whitespace-nowrap">{{ optional($item['service'])->duration }} minutes</td>
                            <td class="">
                                <form action="{{ route('services.remove') }}" class="mx-auto bg-white w-fit flex items-center p-0.5 rounded" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <input type="hidden" name="service_id" value="{{ optional($item['service'])->id }}">
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
        </div>
    </div>

</x-guest-layout>
