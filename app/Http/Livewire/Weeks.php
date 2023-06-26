<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Livewire\WithPagination;

class Weeks extends Component
{
    use WithPagination;

    public $results;
    public $workDays = ['mon', 'tue', 'fri', 'sat'];

    public $selectedDate;

    public $page = 1;
    protected $queryString = ['selectedDate', 'page'];

    public function mount()
    {
        // Set the initial selected date to the current year and month
        $this->selectedDate = date('Y-m');
    }

    public function render()
    {
        $year = date('Y', strtotime($this->selectedDate));
        $month = date('m', strtotime($this->selectedDate));
        $currentDay = date('d');

        $totalDays = cal_days_in_month(CAL_GREGORIAN, $month, $year);

        $weeksOfMonth = [];
        $day = 1;

        while ($day <= $totalDays) {
            $week = date('W', strtotime("$year-$month-$day"));
            $dayOfWeek = date('D', strtotime("$year-$month-$day"));

            // Only add days that are in the selected month and are after or on the current day
            if ($month == date('m') && $day >= $currentDay || $month != date('m')) {
                $weeksOfMonth[$week][] = ['day' => $day, 'dayOfWeek' => $dayOfWeek];
            }

            $day++;
        }

        // Sort the weeks by their numerical key (week number)
        ksort($weeksOfMonth);

        return view('livewire.weeks', [
            'weeks' => $weeksOfMonth,
            'month' => date_create_from_format('m', $month)->format('F'),
            'year' => $year,
            'currentPage' => $this->page ?: 1,
        ]);
    }



    public function updated($propertyName)
    {
        if ($propertyName === 'selectedDate') {
            $this->selectedDate = date('Y-m', strtotime($this->selectedDate));
            $this->resetPage(); // Reset pagination when the month changes
        }
    }
    public function nextMonth(){
        $this->selectedDate = date('Y-m', strtotime($this->selectedDate . ' +1 month'));
        $this->resetPage(); // Reset pagination when the month changes
    }

    public function previousMonth()
    {
        $currentMonth = date('m');
        $selectedMonth = date('m', strtotime($this->selectedDate));

        if ($selectedMonth != $currentMonth) {
            $this->selectedDate = date('Y-m', strtotime($this->selectedDate . ' -1 month'));
            $this->resetPage(); // Reset pagination when the month changes
        }
    }


//    public function selectedYearMonth(){
//
//        dd($this->$selectedDate);
//    }

    public function outputDate($date)
    {
        $this->selectedDate = $date;
        session()->put('booking-date', $date);
        return redirect('/booking/step/3/');
    }

}
