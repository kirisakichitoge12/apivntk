<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PreSeat extends Model
{
    protected $fillable = [
        'passenger_id', 'airline', 'code', 'confirmed', 'currency',
        'start_point', 'end_point', 'leg', 'name', 'price', 'session', 'value'
    ];

    public function passenger()
    {
        return $this->belongsTo(Passenger::class, 'passenger_id');
    }
}
