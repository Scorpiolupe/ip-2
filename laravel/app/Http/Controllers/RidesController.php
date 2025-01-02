<?php
namespace App\Http\Controllers;

use App\Models\RideRequest;
use App\Models\RideHistory;
use App\Models\Driver;
use App\Models\DriverEarning;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class RidesController extends Controller
{
    public function index()
    {

        $user = Auth::user();
        if (!Auth::check()) {
            return redirect()->route('login');
        }

        if ($user->canDrive) {
            
            $driver = Driver::where('user_id', $user->id)->first();
            
            if (!$driver) {
                return back()->with('error', 'Sürücü kaydı bulunamadı.');
            }

            
            $activeRides = RideRequest::where('driver_id', $driver->id)
                                    ->whereNull('completed_at')
                                    ->get();
            
            $completedRides = RideHistory::where('driver_id', $driver->id)
                                       ->orderBy('created_at', 'desc')
                                       ->get();

            return view('ridehistory', compact('activeRides', 'completedRides'));
        } else {
            $rides = RideHistory::where('passenger_id', $user->id)
                              ->orderBy('created_at', 'desc')
                              ->get();
            
            $activeRequests = RideRequest::where('passenger_id', $user->id)
                                       ->whereNull('completed_at')
                                       ->get();

            return view('ridehistory', compact('rides', 'activeRequests'));
        }
    }

    public function completeRide(Request $request, $id)
    {
        try {
            
            DB::beginTransaction();

            $rideRequest = RideRequest::findOrFail($id);
            $driver = Driver::where('user_id', Auth::id())->first();

            if (!$driver) {
                return back()->with('error', 'Sürücü kaydı bulunamadı.');
            }

            $rideHistory = new RideHistory();
            $rideHistory->passenger_id = $rideRequest->passenger_id;
            $rideHistory->driver_id = $driver->id;
            $rideHistory->start_location = $rideRequest->pickup_location . ', ' . $rideRequest->pickup_city;
            $rideHistory->end_location = $rideRequest->dropoff_location . ', ' . $rideRequest->dropoff_city;
            $rideHistory->start_time = $rideRequest->pickup_time;
            $rideHistory->end_time = now()->format('Y-m-d H:i:s');
            $rideHistory->status = 'Tamamlandı';
            $rideHistory->price = $request->price;
            $rideHistory->created_at = now();
            $rideHistory->save();

            $rideRequest->completed_at = now();
            $rideRequest->save();

            $drivers = Driver::all();

            foreach ($drivers as $driver) {

                $totalEarnings = RideHistory::where('driver_id', $driver->id)
                                     ->where('status', 'Tamamlandı')
                                     ->sum('price');


                $driverEarning = DriverEarning::firstOrCreate(
                    ['driver_id' => $driver->id],
                    ['earned' => 0] 
                );
            

                $driverEarning->earned = $totalEarnings;
                $driverEarning->save();
            }

            DB::commit();
            return redirect()->route('rides.index')->with('success', 'Yolculuk başarıyla tamamlandı.');

        } catch (\Exception $e) {
            DB::rollBack();
            return back()->with('error', 'Bir hata oluştu: ' . $e->getMessage());
        }
    }
}