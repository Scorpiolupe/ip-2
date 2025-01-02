<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Complaint extends Model
{
    protected $fillable = [
        'name',
        'email',
        'phone',
        'complaint'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
