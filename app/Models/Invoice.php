<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Invoice extends Model
{
    protected $fillable = [
        'booking_id', 'company_name', 'company_tax_code', 'company_address',
        'receiver_name', 'receiver_address', 'receiver_phone', 'receiver_email', 'remark'
    ];

    public function booking()
    {
        return $this->belongsTo(Booking::class, 'booking_id');
    }
}
