<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProductPhoto extends Model
{
    protected $table = "product_photos";
    protected $primaryKey = "id";

    protected $fillable = [
        'product_id' ,
        'name' ,
        'url' ,
        'created_at' ,
        'updated_at' ,
        'delete_at',
    ];

    protected $dates = [
        "created_at" ,
        "updated_at" ,
        "deleted_at"
    ];
    
    public function product()
    {
        return $this->belongsTo(Product::class, 'product_id', 'id');
    }
}
