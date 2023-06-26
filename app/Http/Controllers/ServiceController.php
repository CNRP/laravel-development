<?php

namespace App\Http\Controllers;
use App\Http\Controllers\BookingController;
use App\Models\User;
use App\Models\Service;
use App\Models\Client;
use App\Models\Booking;
use Illuminate\Http\Request;
use DateTimeImmutable;
use Carbon\Carbon;
class ServiceController extends Controller
{

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|string',
            'description' => 'nullable|string',
            'price' => 'required|numeric',
            'duration' => 'required|integer',
            'category' => 'nullable|string',
        ]);

        Service::create($validatedData);

        return redirect()->route('services.index')->with('success', 'Service created successfully.');
    }

    public function index()
    {
        $services = Service::all();

        return view('booking/services-dashboard', compact('services'));
    }


    public function destroy(Request $request, $id){
        $service = Service::findOrFail($id);
        $service->delete();

        return redirect()->route('services.index')->with('success', 'Service deleted successfully.');
    }
    public function clearBooking(){
        session()->forget('booking');
        return redirect()->back()->with('success', 'Booking cleared successfully.');
    }

    public function remove(Request $request){

        $serviceId = $request->input('service_id');
        $booking = session()->get('booking', []);

        // Filter out the item with the matching ID
        $booking = array_filter($booking, function ($item) use ($serviceId) {
            return optional($item['service'])->id != $serviceId;
        });

        // Update the session variable with the modified booking
        session()->put('booking', $booking);

        return redirect()->back()->with('success', 'Item removed from the booking.');
    }


    public function add(Request $request){

        $serviceId = $request->input('id');
        $service = Service::where('id', $serviceId)->first();

        if ($service) {
            $booking = session()->get('booking', []);

            $booking[] = [
                'service' => $service,
            ];

            session()->put('booking', $booking);
            return redirect()->back()->with('success', 'Product.php added to cart.');
        }
        return redirect()->back()->with('error', 'Product.php not found.');
    }


}
