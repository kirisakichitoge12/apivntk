<?php
// app/Models/BannerTintuc.php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BannerTintuc extends Model
{
    protected $table = 'banners_tintuc';

    protected $fillable = [
        'image_path',
        'alt',
        'title',
        'link',
        'lazy',
    ];
}
