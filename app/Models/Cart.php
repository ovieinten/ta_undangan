<?php

namespace App\Models;

use App\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


class Cart extends Model
{
    use SoftDeletes;

    protected $table = "carts";
    protected $primaryKey = "id";

    protected $fillable = [
        'user_id' ,
        'product_id' ,
        'qty' ,
        'created_at' ,
        'updated_at' ,
        'delete_at',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    public function product()
    {
        return $this->belongsTo(Product::class, 'product_id', 'id');
    }
}
