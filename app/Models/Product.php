<?php

namespace App\Models;

use App\User;
use willvincent\Rateable\Rateable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Product extends Model
{
    use Rateable;

    protected $table = "products";
    protected $primaryKey = "id";

    protected $fillable = [
        'name' ,
        'price' ,
        'desc' ,
        'slug' ,
        'user_id',
        'category_id',
        'shape_id',
        'size_id',
        'color_id',
        'status' ,
        'note' ,
        'created_at' ,
        'updated_at' ,
        'deleted_at' ,
    ];

    protected $dates = [
        "created_at" ,
        "updated_at" ,
        "deleted_at"
    ];

    public function category()
    {
        return $this->belongsTo(Category::class, 'category_id', 'id');
    }

    public function size()
    {
        return $this->belongsTo(Size::class, 'size_id', 'id');
    }

    public function color()
    {
        return $this->belongsTo(Color::class, 'color_id', 'id');
    }

    public function shape()
    {
        return $this->belongsTo(Shape::class, 'shape_id', 'id');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    public function comments()
    {
        return $this->hasMany(Comment::class, 'comment_id', 'id');
    }

    public function discount()
    {
        return $this->hasOne(Discount::class, 'product_id', 'id');
    }

    public function photos()
    {
        return $this->hasMany(ProductPhoto::class, 'product_id', 'id');
    }
}
