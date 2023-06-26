<?php

namespace App\Http\Livewire;
use App\Models\Service;

use Livewire\Component;

class ServicesTable extends Component
{
    public $categories;
    public $services;

    public function mount()
    {
        $this->services = Service::all();
        $this->categories = $this->services->pluck('category')->unique();
    }

    public function render()
    {
//        $booking = session()->get('booking') ?? [];

        return view('livewire.services-table', [
            'categories' => $this->categories,
            'services' => $this->services,
        ]);
    }
}
