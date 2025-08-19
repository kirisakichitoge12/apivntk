<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BannerVemaybaynoidia extends Model
{
    protected $table = 'banners_vemaybaynoidia';
    protected $fillable = ['image_path', 'alt', 'title', 'link', 'lazy'];
}