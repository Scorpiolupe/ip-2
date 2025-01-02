<?php

namespace App\Http\Controllers;

use App\Models\Driver;
use App\Models\DriverEarning;
use App\Models\Passenger;
use App\Models\User;
use App\Models\Vehicle;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Symfony\Component\Mailer\DelayedEnvelope;

class DriverController extends Controller
{
    public function index()
    {
        return view('driver-form');
    }

    public function submitForm(Request $request)
    {
        if (!Auth::check()) {
            return redirect()
                ->route('driverForm')
                ->withInput()
                ->withErrors(['error' => 'Başvurunuz alınamadı. Lütfen giriş yapın.']);
        }

        try {
            DB::beginTransaction();

            $validated = $request->validate([
                'vehicle_model' => 'required|string|max:255',
                'vehicle_license_plate' => 'required|string|max:10',
                'vehicle_age' => 'required',
                'bio' => 'string',
                'license' => '',
                'registration' => '',
                'profile_photo_url' => '',
            ]);

            $user = Auth::user();

            $validated['user_id'] = $user->id; 
            $validated['name'] = $user->name;
            $validated['tel'] = $user->tel;

            Driver::create($validated);

            if ($user) {
            User::where('id', $user->id)
                ->update(['canDrive' => true]);
            }


            // Vehiclesa araç eklemek için
            Vehicle::create([
                'user_id' => $user->id,
                'driver_name' => $user->name,
                'vehicle_model' => $validated['vehicle_model'],
                'license_plate' => $validated['vehicle_license_plate'],
                'vehicle_age' => $validated['vehicle_age'] 
            ]);

            

            DriverEarning::create([
                'driver_id' => $user->id,
                'earned', 'integer'
            ]);


            Passenger::where('user_id', $user->id)->delete();

            DB::commit();

            return back()->with('success', 'Şoförlük başvurunuz başarıyla alındı! En kısa zamanda işe başlayabilirsiniz.');

        } catch (\Exception $e) {
            DB::rollBack();
            Log::error('Error: ' . $e->getMessage(), [
                'request' => $request->all(),
                'user_id' => Auth::id()
            ]);

            return redirect()
                ->route('driverForm')
                ->withInput()
                ->withErrors(['error' => 'Hata: ' . $e->getMessage()]);
        }
    }





    // driver.blade.php için
    public function drivers()
    {
        $drivers = Driver::all();
        return view('drivers', compact('drivers'));
    }

}
