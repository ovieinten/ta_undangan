<?php

namespace App\Models;

use App\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Payment extends Model
{
    use SoftDeletes;

    protected $table = "payments";
    protected $primaryKey = "id";

    protected $fillable = [
        'user_id' ,
        'confirm_user_id' ,
        'order_id' ,
        'desc' ,
        'image' ,
        'created_at' ,
        'updated_at' ,
        'delete_at',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    public function order()
    {
        return $this->belongsTo(Order::class, 'order_id', 'id');
    }
}
