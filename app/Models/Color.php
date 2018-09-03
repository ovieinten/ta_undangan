<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Color extends Model
{
 	protected $table = "colors";
 	protected $primaryKey = "id";

 	protected $fillable = [
        'parent_id' ,
        'name' ,
        'slug' ,
        'created_at' ,
        'updated_at' ,
        'deleted_at' ,
 	];

    public function products()
    {
        return $this->hasMany(Product::class, 'color_id', 'id');
    }

    public function creations()
    {
        return $this->hasMany(Product::class, 'color_id', 'id');
    }
}
