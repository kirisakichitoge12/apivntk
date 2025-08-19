<?php
// app/Models/BackgroundHome.php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;

class BackgroundHome extends Model {
    protected $table = 'backgrounds_home';
    protected $fillable = ['image_path','alt','lazy'];
}
