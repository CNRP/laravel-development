<?php

namespace App\Http\Controllers;
use App\Models\User;
use App\Models\Client;
use App\Models\Booking;
use App\Models\Service;
use Illuminate\Http\Request;
use DateTimeImmutable;
use App\Controllers\ServiceController;
use Illuminate\Support\Facades\Validator;

use Carbon\Carbon;
class BookingController extends Controller
{
    protected $startTime;
    protected $endTime;

    public function __construct()
    {
        $this->startTime = Carbon::parse('07:00'); // Set your desired start time
        $this->endTime = Carbon::parse('22:00'); // Set your desired end time
    }

    public function getStartTime(): Carbon
    {
        return $this->startTime;
    }

    public function getEndTime(): Carbon
    {
        return $this->endTime;
    }

//    public function register()
//    {
//        $this->app->singleton(BookingController::class, function ($app) {
//            return new BookingController();
//        });
//    }

    public function dashboard($date = null)
    {
        $appointments = Booking::all();

        $events = [];
        foreach ($appointments as $appointment) {
            $events[] = [
                'title' => $appointment->client->name,
                'start' => $appointment->start_time,
                'end' => $appointment->finish_time,
            ];
        }
        return view('booking/booking-dashboard', compact('events', 'appointments'));
    }

    public function index()
    {
        // Provide necessary data to the booking form view if needed
        return redirect()->route('booking.step', ['step' => 1])->with('success', 'Please fill out our booking form');
    }

    public function step($step)
    {
        $services = Service::all();
        $booking = session()->get('booking') ?? [];

        $staffUsers = User::whereHas('role', function ($query) {
            $query->where('name', 'staff');
        })->get();

        $results = $this->getAppointmentOptions(session('booking-date'));


        // Provide necessary data to the booking form view if needed
        return view('booking/booking', compact( 'results', 'step', 'booking'));
//        $events = [];
//        return view('booking/services-dashboard', compact('events'));
    }

    public function submitAppointment(Request $request)
    {
        // Retrieve the data from the request
        $bookingDate = $request->input('booking_date');
        $bookingTime = $request->input('booking_time');
        $clientName = $request->input('client_name');
        $clientEmail = $request->input('client_email');
        $comments = $request->input('comments');


        // Check if the client with the given email already exists
        $user = User::where('client_email', $clientEmail)->first();

        [$startTime, $finishTime] = explode(' > ', $bookingTime);

        $startDateTime = \Carbon\Carbon::createFromFormat('Y-m-d h:ia', $bookingDate . ' ' . $startTime);
        $finishDateTime = \Carbon\Carbon::createFromFormat('Y-m-d h:ia', $bookingDate . ' ' . $finishTime);

        // Create the appointment
        $appointment = Booking::create([
            'start_time' => $startDateTime, // Adjust this based on the start time format in your appointment model
            'finish_time' => $finishDateTime, // Set this based on your business logic
            'comments' => $comments,
            'client_email' => $clientEmail,
            'employee_id' => '1', // Set this based on your business logic
        ]);

        if ($appointment) {
            return redirect()->route('booking.step', ['step' => 4])->with('success', 'Booking created successfully');
        } else {
            return redirect()->route('booking.step', ['step' => 4])->with(['error' => 'Failed to create booking. Please try again.']);
        }

    }


    public function getAvailableTimeSlots($duration)
    {
        $parsedDate = \Carbon\Carbon::parse(session('booking-date'))->startOfDay();
        $nextDay = $parsedDate->copy()->addDay();

        // Get all existing appointments on the specified date
        $existingAppointments = Booking::where('start_time', '>=', $parsedDate)
            ->where('finish_time', '<', $nextDay)
            ->get();

        // Initialize available time slots array
        $availableTimeSlots = [];

        // Convert the start and end times to include date
        $startTime = $parsedDate->copy()->addHours($this->startTime->hour)->addMinutes($this->startTime->minute);
        $endTime = $parsedDate->copy()->addHours($this->endTime->hour)->addMinutes($this->endTime->minute);

        // Loop through the time block and check for availability
        $currentTime = $startTime;
        while ($currentTime->lt($endTime)) {
            $isAvailable = true;

            // Calculate the finish time based on the current time and appointment duration
            $finishTime = $currentTime->copy()->addMinutes($duration);

            // Check if the current time slot overlaps with any existing appointments
            foreach ($existingAppointments as $appointment) {
                $appointmentStart = Carbon::parse($appointment->start_time);
                $appointmentEnd = Carbon::parse($appointment->finish_time);

                // Check for overlap
                if ($appointmentStart->lt($finishTime) && $appointmentEnd->gt($currentTime)) {
                    $isAvailable = false;
                    break;
                }
            }

            // If the time slot is available, add it to the availableTimeSlots array
            if ($isAvailable) {
                $availableTimeSlots[] = $currentTime->format('g:ia') . ' > ' . $finishTime->format('g:ia');
            }

            // Increment the current time by 15 minutes
            $currentTime->addMinutes(15);
        }

        // Return the available time slots
        return $availableTimeSlots;
    }

    public function getAppointmentOptions()
    {
        $appController = new BookingController();

        $availableTimeSlots = $this->getAvailableTimeSlots($this->getTotalDuration());

        $startTime = $this->startTime; // Set your desired start time
        $endTime = $this->endTime; // Set your desired end time

        $currentTime = $startTime;
        $timeSlots = [];

        while ($currentTime < $endTime) {
            $formattedTime = date('g:ia', strtotime($currentTime));
            $timeSlots[] = [
                'value' => $currentTime,
                'label' => $formattedTime
            ];
            $currentTime = date('H:i:s', strtotime($currentTime . '+1 hour'));
        }


        $results = [];

        foreach ($timeSlots as $timeSlot) {

            preg_match('/(\d+)(?::\d+)?(am|pm)/i', $timeSlot['label'], $matches);
            $ranges = []; // Initialize an array to store the time slot ranges

            foreach ($availableTimeSlots as $appointment) {
                // Split the time slot by '-'
                $timeRange = explode('-', $appointment);
                $startTime = trim($timeRange[0]); // Trim leading/trailing spaces from start time


                // Extract the hour label and AM/PM indicator from the start time
                preg_match('/(\d+)(?::\d+)?(am|pm)/i', $startTime, $matches2);

                // Compare $timeMatches with the extracted hour label and AM/PM indicator
                if ($matches[1] === $matches2[1] && $matches[2] === $matches2[2]) {
                    // Add the time slot range to the ranges array
                    $ranges[] = $appointment;
                }

            }

            $results[] = [
                'label' => $timeSlot['label'],
                'slots' => $ranges,
            ];
        }
        return $results;
    }

    public function getTotalDuration()
    {
        $booking = session()->get('booking', []);
        $totalDuration = 0;

        foreach ($booking as $item) {
            $service = $item['service'];
            $totalDuration += $service->duration;
        }

        return $totalDuration;
    }


    public function destroy($id){
        $booking = Booking::findOrFail($id);
        $booking->delete();

        return redirect()->back()->with('success', 'Appointment deleted successfully.');
    }
}
