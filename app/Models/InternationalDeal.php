<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class InternationalDeal extends Model
{
    use HasFactory;

    protected $fillable = [
        'airline',
        'airline_logo',
        'from',
        'to',
        'date_range',
        'price',
        'trip_type',
    ];
}
