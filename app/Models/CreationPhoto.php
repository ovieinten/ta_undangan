<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CreationPhoto extends Model
{
    protected $table = "creation_photos";
    protected $primaryKey = "id";

    protected $fillable = [
        'creation_id' ,
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

    public function creation()
    {
        return $this->belongsTo(Creation::class, 'creation_id', 'id');
    }
}
