<?php
use App\Models\Service;
$services = App\Models\Service::all();

?>
<x-guest-layout>

    <div class="py-6">
        <div class="max-w-7xl flex mx-auto gap-8 sm:px-6 lg:px-8">
            <div class="bg-white w-1200 px-8 py-8 overflow-hidden shadow-xl sm:rounded-lg">

                @if($feed)
                    <h1>Yo</h1>
                @endif

            </div>
        </div>
    </div>

</x-guest-layout>
