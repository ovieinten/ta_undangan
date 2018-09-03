<?php

namespace App\Models;

use App\User;
use Illuminate\Database\Eloquent\Model;

class Notification extends Model
{
    protected $table = "notifications";
    protected $primaryKey = "id";

    protected $fillable = [
        'from_user_id' ,
        'to_user_id' ,
        'text' ,
        'read_at' ,
        'created_at' ,
        'updated_at' ,
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }
}
