<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\BookingFlight;
use App\Models\BookingServiceFee;
use App\Models\BookingService;

class Booking extends Model
{
    public $timestamps = true;
    protected $fillable = [
        'guest_area', 'guest_phone', 'guest_email', 
        'guest_name', 'guest_address', 'guest_remark',
        'agent_email', 'agent_phone', 'total_price', 'currency'
    ];
    protected $casts = [
        'start_date' => 'datetime',
        'end_date'   => 'datetime',
    ];

    public function airOptions()
    {
        return $this->hasMany(AirOption::class, 'booking_id');
    }

    public function passengers()
    {
        return $this->hasMany(Passenger::class, 'booking_id');
    }

    public function invoice()
    {
        return $this->hasOne(Invoice::class, 'booking_id');
    }
        // App\Models\Booking.php
    public function ListAirOption()
    {
        return $this->hasMany(AirOption::class, 'booking_id'); // booking_id là foreign key
    }

    public function ListPassenger()
    {
        return $this->hasMany(Passenger::class, 'booking_id');
    }

    public function flights()
    {
        return $this->hasMany(BookingFlight::class);
    }
    public function service_fees()
    {
        return $this->hasMany(BookingServiceFee::class);
    }
    public function services()
    {
        return $this->hasMany(BookingService::class);
    }
    public function detail()
    {
        return $this->hasOne(BookingDetail::class);
    }


}
