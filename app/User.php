<?php

namespace App;

use App\Models\Product;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'email' ,
        'password' ,
        'first_name' ,
        'last_name' ,
        'avatar' ,
        'gender' ,
        'birth_place' ,
        'birth_date' ,
        'phone' ,
        'role_id'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password' , 'remember_token' ,
    ];

    public function products()
    {
        return $this->hasMany(Product::class , 'user_id' , 'id');
    }

    public function role()
    {
        return $this->belongsTo(Role::class, 'role_id', 'id');
    }
}
