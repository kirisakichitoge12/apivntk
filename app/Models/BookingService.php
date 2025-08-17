<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BookingService extends Model
{
    protected $fillable = [
        'booking_id', 'system', 'airline', 'type',
        'name', 'price', 'currency'
    ];

    public function booking()
    {
        return $this->belongsTo(Booking::class);
    }
}
