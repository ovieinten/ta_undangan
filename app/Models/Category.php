<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Category extends Model
{
    // use SoftDeletes;

    protected $table = "categories";
    protected $primaryKey = "id";

    protected $fillable = [
        'name' ,
        'desc' ,
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
        return $this->hasMany(Product::class, 'category_id', 'id');
    }

    public function creations()
    {
        return $this->hasMany(Product::class, 'category_id', 'id');
    }
}
