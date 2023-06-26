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
            <div class="bg-white w-1200 px-8 py-8 overflow-hidden shadow-xl sm:rounded-lg">
            @if(isset($result))
                {{ $result }}
            @endif
                @if(isset($was_succesful))
                    @if($was_successful)
                        <p>Yes, we can now use your instagram feed</p>
                    @else
                        <p>Sorry, we failed to get permission to use your insagram feed.</p>
                    @endif
                @endif

                @if(isset($instagram_auth_url))
                    <a href="{{ $instagram_auth_url }}">Click to get Instgram permission</a>
                @endif

            </div>
        </div>
    </div>

</x-guest-layout>
