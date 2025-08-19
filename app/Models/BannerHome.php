<?php
// app/Models/BannerHome.php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;

class BannerHome extends Model {
    protected $table = 'banners_home';
    protected $fillable = ['image_path','alt','title','link','lazy'];
}

