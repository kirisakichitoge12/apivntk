<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Booking extends Model
{
    protected $fillable = [
        'guest_area', 'guest_phone', 'guest_email', 
        'guest_name', 'guest_address', 'guest_remark',
        'agent_email','agent_phone','total_price','currency'
    ];
    public function ListPassenger()
    {
        return $this->hasMany(Passenger::class);
    }
    public function ListAirOption()
    {
        return $this->hasMany(AirOption::class);
    }
    public function Invoice()
    {
        return $this->hasOne(Invoice::class);
    }
}
