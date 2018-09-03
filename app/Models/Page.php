<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Page extends Model
{
    use SoftDeletes;

    protected $table = "pages";
    protected $primaryKey = "id";

    protected $fillable = [
        'title' ,
        'is_home' ,
        'title' ,
        'slug' ,
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
}
