<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ListMembership extends Model
{
    protected $fillable = [
        'passenger_id', 'airline', 'membership_id'
    ];

    public function passenger()
    {
        return $this->belongsTo(Passenger::class);
    }
}
