<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RideRequest extends Model
{
    use HasFactory;

    protected $fillable = [
        'pickup_location',
        'dropoff_location',
        'pickup_time',
        'passenger_count',
        'special_requests',
        'passenger_id',
        'driver_id',
        'completed_at'
    ];

    public $timestamps = false;


    public function driver()
    {
        return $this->belongsTo(Driver::class, 'driver_id');
    }


    public function passenger()
    {
        return $this->belongsTo(User::class, 'passenger_id');
    }
}