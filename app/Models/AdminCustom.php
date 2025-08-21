<?php
// app/Models/AdminCustom.php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Hash;

class AdminCustom extends Model
{
    protected $table = 'admins_custom';
    protected $fillable = ['name', 'email', 'password', 'is_super_admin'];

    protected $hidden = ['password'];

    public function setPasswordAttribute($value){
        $this->attributes['password'] = Hash::make($value);
    }
}
