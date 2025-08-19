<?php
// app/Models/BackgroundKhuyenmai.php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BackgroundKhuyenmai extends Model
{
    protected $table = 'backgrounds_khuyenmai';

    protected $fillable = [
        'image_path',
        'alt',
        'lazy',
    ];
}
