<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class HomeContent extends Model
{
    protected $fillable = [
        'title',
        'content1',
        'content2',
        'image1',
        'image2',
        'image3',
    ];
}