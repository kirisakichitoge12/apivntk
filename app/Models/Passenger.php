<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\ListMembership;

class Passenger extends Model
{
    protected $fillable = [
        'booking_id', 'index', 'type', 'gender',
        'document_type', 'nationality', 'issue_country',
        'seat_class','title','full_name','given_name','surname','date_of_birth',
        'passport_documentType','passport_nationality','passport_issue_country'
    ];

    public function booking()
    {
        return $this->belongsTo(Booking::class, 'booking_id');
    }

    public function baggages()
    {
        return $this->hasMany(Baggage::class, 'passenger_id');
    }

    public function services()
    {
        return $this->hasMany(Service::class, 'passenger_id');
    }

    public function preSeats()
    {
        return $this->hasMany(PreSeat::class, 'passenger_id');
    }
    public function list_baggage()
    {
        return $this->hasMany(Baggage::class, 'passenger_id'); // passenger_id là foreign key trong bảng baggage
    }
    public function list_preSeat()
    {
        return $this->hasMany(PreSeat::class, 'passenger_id'); // passenger_id là foreign key trong bảng pre_seats
    }
    public function list_membership()
    {
        return $this->hasMany(ListMembership::class);
    }
    public function list_service()
    {
        return $this->hasMany(Service::class, 'passenger_id');
    }

}
