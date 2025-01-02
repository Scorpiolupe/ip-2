<?php

namespace App\Http\Controllers;

use App\Models\Passenger;
use App\Models\Session;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{

    // GİRİŞ

    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required|min:6',
        ], [
            'email.required' => 'E-posta alanı zorunludur.',
            'email.email' => 'Geçerli bir e-posta adresi giriniz.',
            'password.required' => 'Şifre alanı zorunludur.',
            'password.min' => 'Şifre en az 6 karakter olmalıdır.'
        ]);

        try {
            if (Auth::attempt($request->only('email', 'password'))) {
                $user = Auth::user();
                
                User::where('id', $user->id)
                ->update(['is_active' => true]);
                
                return redirect()->route('index')->with('success', 'Hoş geldiniz!');
            }

            return back()->withErrors([
                'error' => 'E-posta veya şifre hatalı.'
            ])->withInput($request->except('password'));
        } catch (\Exception $e) {
            return back()->withErrors([
                'error' => 'Giriş işlemi sırasında bir hata oluştu.'
            ])->withInput($request->except('password'));
        }
    }



    // KAYIT

    public function register(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users|max:255',
            'tel' => 'required|string|min:10|max:11|unique:users',
            'password' => [
                'required',
                'string',
                'min:8',
                'confirmed'
            ],
            'gender' => 'required|in:man,woman'
        ], [
            'name.required' => 'Ad Soyad alanı zorunludur.',
            'name.max' => 'Ad Soyad en fazla 255 karakter olabilir.',
            'email.required' => 'E-posta alanı zorunludur.',
            'email.email' => 'Geçerli bir e-posta adresi giriniz.',
            'email.unique' => 'Bu e-posta adresi zaten kullanımda.',
            'tel.required' => 'Telefon numarası zorunludur.',
            'tel.min' => 'Telefon numarası en az 10 karakter olmalıdır.',
            'tel.max' => 'Telefon numarası en fazla 11 karakter olmalıdır.',
            'tel.unique' => 'Bu telefon numarası zaten kullanımda.',
            'password.min' => 'Şifre minimum 8 karakter olmalı.',
            'password.required' => 'Şifre belirlemeniz gerekiyor.',
            'password.confirmed' => 'Şifre tekrarı eşleşmiyor.',
            'gender.required' => 'Cinsiyet seçimi zorunludur.',
            'gender.in' => 'Geçersiz cinsiyet seçimi.'
        ]);
    
        try {
            DB::beginTransaction();
        
            $user = User::create([
                'name' => $validated['name'],
                'email' => $validated['email'],
                'tel' => $validated['tel'],
                'password' => Hash::make($validated['password']),
                'gender' => $validated['gender'],
                'is_active' => false,
                'canDrive' => false
            ]);
        
            
            if (!$user->canDrive) {
                Passenger::create([
                    'user_id' => $user->id,
                    'name' => $validated['name'],
                    'email' => $validated['email'],
                    'tel' => $validated['tel'],
                    'gender' => $validated['gender'],
                ]);
            }
        
            DB::commit();
        
            return redirect()->route('login')->with('success', 'Kayıt başarılı. Giriş yapabilirsiniz.');
        } catch (\Exception $e) {
            DB::rollBack();
            return back()->withInput()
                ->withErrors(['error' => 'Kayıt işlemi sırasında bir hata oluştu.']);
        }
    }


    // ÇIKIŞ

    public function logout(Request $request)
    {
        $user = Auth::user();
        if ($user) {
            User::where('id', $user->id)
                ->update(['is_active' => false]);
        }

        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('index')->with('success', 'Çıkış yapıldı.');
    }
}