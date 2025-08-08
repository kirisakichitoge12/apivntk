<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AirOption extends Model
{
    protected $fillable = [
        'session', 'session_type'
    ];

    public function booking()
    {
        return $this->belongsTo(Booking::class);
    }
}
