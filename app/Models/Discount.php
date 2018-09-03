<?php

namespace App\Models;

use App\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


class Discount extends Model
{
    use SoftDeletes;

    protected $table = "discounts";
    protected $primaryKey = "id";

    protected $fillable = [
        'product_id' ,
        'percent' ,
        'date_start' ,
        'date_end' ,
        'created_at' ,
        'updated_at' ,
        'delete_at',
    ];

    public function product()
    {
        return $this->belongsTo(Product::class, 'product_id', 'id');
    }
}
