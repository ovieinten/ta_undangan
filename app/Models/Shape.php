<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Shape extends Model
{
    protected $table = "shapes";
    protected $primaryKey = "id";

    protected $fillable = [
        'name' ,
        'slug' ,
        'created_at' ,
        'updated_at' ,
        'deleted_at' ,
    ];

    public function products()
    {
        return $this->hasMany(Product::class, 'shape_id', 'id');
    }

    public function creations()
    {
        return $this->hasMany(Product::class, 'shape_id', 'id');
    }
}
