<?php
// app/Models/BannerVemaybayquocte.php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BannerVemaybayquocte extends Model
{
    protected $table = 'banners_vemaybayquocte';

    protected $fillable = [
        'image_path',
        'alt',
        'title',
        'link',
        'lazy',
    ];
}
