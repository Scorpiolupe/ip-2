<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Reservation extends Model
{
    protected $fillable = [
        'contact_id',
        'name',
        'email',
        'phone',
        'reservation'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
