<?php
namespace App\Http\Controllers;

use App\Models\Driver;
use App\Models\RideRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TaxiController extends Controller
{
    public function call(Request $request)
    {
        $validatedData = $request->validate([
            'pickup_location' => 'required',
            'pickup_city' => 'required',
            'dropoff_location' => 'required',
            'dropoff_city' => 'required',
            'pickup_time' => 'required',
            'passenger_count' => 'required|numeric|min:1',
            'special_requests' => 'nullable'
        ]);

        $availableDriver = Driver::inRandomOrder()->first();
        
        if (!$availableDriver) {
            return back()->with('error', 'Şu anda müsait sürücü bulunmamaktadır.');
        }

        $rideRequest = new RideRequest([
            'pickup_location' => $validatedData['pickup_location'] . ', ' . $validatedData['pickup_city'],
            'dropoff_location' => $validatedData['dropoff_location'] . ', ' . $validatedData['dropoff_city'],
            'pickup_time' => $validatedData['pickup_time'],
            'passenger_count' => $validatedData['passenger_count'],
            'special_requests' => $validatedData['special_requests'],
            'passenger_id' => Auth::id(),
            'driver_id' => $availableDriver->id
        ]);

        $rideRequest->save();

        return redirect()->back()->with('success', 'Taksi çağırma işleminiz başarıyla gerçekleşti.');
    }
}