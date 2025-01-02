<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Driver extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'name',
        'bio',
        'vehicle_model',
        'vehicle_license_plate',
        'license',
        'registration',
        'profile_photo_url',
        'tel',
    ];

    public function rideRequests()
    {
        return $this->hasMany(RideRequest::class);
    }
    
    public function rideHistories()
    {
        return $this->hasMany(RideHistory::class);
    }
}
