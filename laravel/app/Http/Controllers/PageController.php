<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PageController extends Controller
{
    public function index(){
        return view('index');
    }

    public function register(){
        return view('register');
    }

    public function login(){
        return view('login');
    }

    public function services(){
        return view('services');
    }

    public function drivers(){
        return view('drivers');
    }

    public function contact(){
        return view('contact');
    }

    public function driverForm(){
        return view('driver-form');
    }

    public function call(){

        $filePath = public_path('storage/tr-cities.txt');
        $cities = file($filePath, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES); 

        return view('call', compact('cities'));

    }
    
}
