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
                    @foreach($feed as $post)
                        <img src={{ $post->url }} alt="A post from my instagram">
                    @endforeach
            </div>
        </div>
    </div>

</x-guest-layout>
