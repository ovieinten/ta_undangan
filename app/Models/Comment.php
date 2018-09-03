<?php

namespace App\Models;

use App\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Comment extends Model
{
    use SoftDeletes;

    protected $table = "comments";
    protected $primaryKey = "id";

    protected $fillable = [
        'parent_id' ,
        'user_id' ,
        'product_id' ,
        'body' ,
        'created_at' ,
        'updated_at' ,
        'deleted_at' ,
    ];

    protected $dates = [
        "created_at" ,
        "updated_at" ,
        "deleted_at"
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    public function products()
    {
        return $this->belongsTo(Product::class, 'category_id', 'id');
    }
}
