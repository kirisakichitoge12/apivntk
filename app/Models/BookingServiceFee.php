<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BookingServiceFee extends Model
{
    protected $fillable = [
        'booking_id', 'name', 'amount', 'currency'
    ];

    public function booking()
    {
        return $this->belongsTo(Booking::class);
    }
}
