<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Flight extends Model
{
    use HasFactory;

    // Chỉ định bảng cụ thể
    protected $table = 've_noi_dia_card';

    // Cho phép fill dữ liệu
    protected $fillable = ['from', 'to', 'date', 'price', 'original_price', 'img'];
    
}
