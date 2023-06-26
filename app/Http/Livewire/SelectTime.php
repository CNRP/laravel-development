<?php

namespace App\Http\Livewire;

use Livewire\Component;

class SelectTime extends Component
{
    public $selectedTime;
    public $results;
    public $selectedSlot;

    public function select($time)
    {
        $this->selectedTime = $time;
    }

    public function render()
    {
        return view('livewire.select-time');
    }

    public function handleSlotSelection($selectedSlot)
    {
        $this->selectedSlot = $selectedSlot;
        session()->put('booking-time', $this->selectedSlot);
        return redirect('/booking/step/4/');
    }
}
