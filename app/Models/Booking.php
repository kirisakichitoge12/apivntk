<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Booking extends Model
{
    protected $fillable = [
    'full_name', 'gender', 'birth_date', 'nationality',
    'document_type', 'document_number', 'country_code', 'phone', 'email', 'address',
    'departure', 'arrival', 'departure_date', 'return_date',
    'airline1', 'airline2', 'seat_class1', 'seat_class2',
    'time_start1', 'time_end1', 'time_start2', 'time_end2',
    'price1', 'price2',
    'selected_seat', 'luggage_label', 'luggage_price', 'voucher_discount',
    'total_price', 'final_total'
];

}
