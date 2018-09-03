<?php

namespace App\Models;

use App\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Creation extends Model
{
    use SoftDeletes;

    protected $table = "creations";
    protected $primaryKey = "id";

    protected $fillable = [
        'name' ,
        'price' ,
        'desc' ,
        'slug' ,
        'user_id',
        'shape_id',
        'size_id',
        'color_id',
        'status' ,
        'created_at' ,
        'updated_at' ,
        'deleted_at' ,
    ];

    protected $dates = [
        "created_at" ,
        "updated_at" ,
        "deleted_at"
    ];

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

    public function photo_creation()
    {
        return $this->hasMany(CreationPhoto::class, 'creation_id', 'id');
    }
}
