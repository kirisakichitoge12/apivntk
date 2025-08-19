<?php
// app/Models/BannerKhuyenmai.php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BannerKhuyenmai extends Model
{
    protected $table = 'banners_khuyenmai';

    protected $fillable = [
        'image_path',
        'alt',
        'title',
        'link',
        'lazy',
    ];
}
