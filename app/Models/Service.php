<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Service extends Model
{
    protected $fillable = [
        'passenger_id', 'system', 'airline', 'value', 'type', 'pax_type',
        'name', 'description', 'price', 'currency', 'leg', 'start_point',
        'end_point', 'confirmed', 'session'
    ];

    public function passenger()
    {
        return $this->belongsTo(Passenger::class, 'passenger_id');
    }
}
