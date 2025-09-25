<?php 
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FlightNoidia extends Model
{
    use HasFactory;

    protected $table = 'flight_noidia';

    protected $fillable = [
        'from',
        'to',
        'departure_date',
        'return_date',
    ];
}
