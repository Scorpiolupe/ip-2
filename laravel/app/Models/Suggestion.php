<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Suggestion extends Model
{
    protected $fillable = [
        'contact_id',
        'name',
        'email',
        'phone',
        'suggestion'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
