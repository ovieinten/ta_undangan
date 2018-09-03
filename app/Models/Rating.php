<?php

namespace App\Models;

use App\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Rating extends Model
{
    public $fillable = ['ratings'];
    /**
     * @return mixed
     */
    public function rateable()
    {
        return $this->morphTo();
    }
    /**
     * Rating belongs to a user.
     *
     * @return User
     */
    public function user()
    {
        return $this->belongsTo('User');
    }
}
