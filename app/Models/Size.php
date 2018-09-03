<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Size extends Model
{
    protected $table = "sizes";
    protected $primaryKey = "id";

    protected $fillable = [
        'name' ,
        'slug' ,
        'created_at' ,
        'updated_at' ,
        'deleted_at' ,
    ];

    public function sub()
    {

    }

    public function parent()
    {

    }

    public function products()
    {
        return $this->hasMany(Product::class, 'size_id', 'id');
    }

    public function creations()
    {
        return $this->hasMany(Product::class, 'size_id', 'id');
    }
}
