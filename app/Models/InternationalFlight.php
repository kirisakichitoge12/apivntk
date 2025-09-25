<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class InternationalFlight extends Model
{
    use HasFactory;

    protected $table = 'international_flights';

    protected $fillable = [
        'from', 'to', 'country', 'date',
        'price', 'original_price', 'img'
    ];
}
