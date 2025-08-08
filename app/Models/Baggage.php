<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Baggage extends Model
{
    protected $fillable = [
        'system', 'airline', 'value', 
        'type', 'pax_type', 'name',
        'description','price','currency','leg','start_point','end_point','confirmed','session'
    ];
    public function passenger()
    {
        return $this->belongsTo(Passenger::class);
    }
}
