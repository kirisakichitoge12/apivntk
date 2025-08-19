<?php
// app/Models/BackgroundTintuc.php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BackgroundTintuc extends Model
{
    protected $table = 'backgrounds_tintuc';

    protected $fillable = [
        'image_path',
        'alt',
        'lazy',
    ];
}
