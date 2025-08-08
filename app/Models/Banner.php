<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Banner extends Model
{
    protected $fillable = ['page', 'image_path', 'alt_text'];

    public function getImageUrlAttribute()
    {
        return asset('storage/' . $this->image_path);
    }
}