<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BookingDetail extends Model
{
    use HasFactory;

    protected $fillable = [
        'booking_id',
        'list_fare',
        'list_baggage',
        'list_service',
        'list_pre_seat',
        'baggage_price',
        'service_price',
        'seat_price',
        'total_fare',
    ];

    protected $casts = [
        'list_fare'      => 'array',
        'list_baggage'   => 'array',
        'list_service'   => 'array',
        'list_pre_seat'  => 'array',
        'baggage_price'  => 'array',
        'service_price'  => 'array',
        'seat_price'     => 'array',
        'total_fare'     => 'array',
    ];

    public function booking()
    {
        return $this->belongsTo(Booking::class);
    }
    
}
