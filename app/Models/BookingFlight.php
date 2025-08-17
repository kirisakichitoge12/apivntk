<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BookingFlight extends Model
{
    protected $fillable = [
        'booking_id', 'airline', 'flight_number',
        'start_point', 'end_point', 'start_date', 'end_date',
        'fare_class','airline_name','start_city','end_city'
    ];

    protected $casts = [
    'start_date' => 'datetime',
    'end_date'   => 'datetime',
    ];

    public function booking()
    {
        return $this->belongsTo(Booking::class);
    }
}
