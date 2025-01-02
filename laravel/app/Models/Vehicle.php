<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Vehicle extends Model
{
    protected $fillable = [
        'user_id',
        'driver_name',
        'vehicle_model',
        'license_plate',
        'vehicle_age'
    ];

}
