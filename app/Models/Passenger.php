<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Passenger extends Model
{
    protected $fillable = [
        'index', 'type', 'gender',
        'document_type', 'nationality', 'issue_country',
        'seat_class','title','full_name','given_name','surname','date_of_birth',
        'passport_documentType','passport_nationality','passport_issue_country'
    ];
    public function booking()
    {
        return $this->belongsTo(Booking::class);
    }
    public function list_baggage()
    {
        return $this->hasMany(Baggage::class);
    }
    public function list_service()
    {
        return $this->hasMany(Service::class);
    }
    public function list_preSeat()
    {
        return $this->hasMany(PreSeat::class);
    }
}
