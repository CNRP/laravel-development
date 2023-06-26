<?php
use App\Models\Service;
$services = App\Models\Service::all();

?>
<x-guest-layout>


    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Services') }}
        </h2>
    </x-slot>

    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Services') }}
        </h2>
    </x-slot>

    <div class="py-6">
        <div class="max-w-7xl flex mx-auto gap-8 sm:px-6 lg:px-8">
            <div class="bg-white w-3/5 px-8 py-8 overflow-hidden shadow-xl sm:rounded-lg">

{{--                @include('booking.partials.booking-items')--}}

                @include('booking.partials.booking-form')

            </div>

            <div class="bg-white w-2/5 px-8 py-8 overflow-hidden h-fit shadow-xl sm:rounded-lg">
                <table class="table-auto divide-y w-full text-left">
                    <thead>
                    <tr class="">
                        <th class="px-4 py-2 ">Service</th>
                        <th class="px-4 py-2">Price</th>
                        <th class="px-4 py-2">Duration</th>
                        <th class="px-4 py-2"></th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach ($booking as $item)
                        <tr>
                            <td class="px-4 py-2 w-24 truncate" style="max-width: 150px;">{{ optional($item['service'])->name }}</td>
                            <td class="px-4 py-2 whitespace-nowrap">£{{ optional($item['service'])->price }}</td>
                            <td class="px-4 py-2 whitespace-nowrap">{{ optional($item['service'])->duration }}</td>
                            <td  class="px-4 py-2">
                                <form action="{{ route('services.remove') }}" method="POST">
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
