<?php
// app/Models/BackgroundVemaybayquocte.php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BackgroundVemaybayquocte extends Model
{
    protected $table = 'backgrounds_vemaybayquocte';

    protected $fillable = [
        'image_path',
        'alt',
        'lazy',
    ];
}
