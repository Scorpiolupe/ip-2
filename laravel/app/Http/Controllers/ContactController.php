<?php

namespace App\Http\Controllers;

use App\Models\Complaint;
use App\Models\Contact;
use App\Models\Reservation;
use App\Models\Suggestion;
use Illuminate\Http\Request;
use Carbon\Carbon;

class ContactController extends Controller
{
    public function index()
    {
        return view('contact');
    }


    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|max:255',
            'email' => 'required|email|max:255',
            'phone' => 'required|max:20',
            'subject' => 'required',
            'message' => 'required'
        ]);

        $validated['is_read'] = false;
        $validated['created_at'] = Carbon::now()->format('Y-m-d H:i:s');
        $validated['updated_at'] = Carbon::now()->format('Y-m-d H:i:s');


        if ($validated['subject'] === 'sikayet') {
            Complaint::create([
                'name' => $validated['name'],
                'email' => $validated['email'],
                'phone' => $validated['phone'],
                'complaint' => $validated['message']
            ]);
            Contact::create($validated);
        
            return redirect()
                ->back()
                ->with('success', 'Şikayetiniz başarıyla alındı. En kısa sürede size dönüş yapacağız.');
        }

        elseif ($validated['subject'] === 'oneri') {
            Suggestion::create([
                'name' => $validated['name'],
                'email' => $validated['email'],
                'phone' => $validated['phone'],
                'suggestion' => $validated['message']
            ]);
            Contact::create($validated);
        
            return redirect()
                ->back()
                ->with('success', 'Öneriniz başarıyla alındı. En kısa sürede size dönüş yapacağız.');
        }

        elseif ($validated['subject'] === 'rezervasyon') {
            Reservation::create([
                'name' => $validated['name'],
                'email' => $validated['email'],
                'phone' => $validated['phone'],
                'reservation' => $validated['message']
            ]);
            Contact::create($validated);
        
            return redirect()
                ->back()
                ->with('success', 'Revervasyonunuz başarıyla alındı. En kısa sürede size dönüş yapacağız.');
        }

        
        

    }
}