<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RideHistory extends Model
{
    use HasFactory;

    protected $fillable = [
        'customer_id', 
        'driver_id', 
        'start_location', 
        'end_location', 
        'start_time', 
        'end_time',
        'status',
        'price'
    ];

    
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    
    public function driver()
    {
        return $this->belongsTo(Driver::class);
    }
}
