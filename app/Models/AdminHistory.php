<?php
// app/Models/AdminHistory.php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AdminHistory extends Model
{
    protected $table = 'admin_histories';
    protected $fillable = ['admin_id','action','table_name','admin_name','details','acted_at'];

    public $timestamps = false;
}
