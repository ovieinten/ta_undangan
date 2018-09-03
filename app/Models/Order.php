<?php

namespace App\Models;

use App\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Order extends Model
{
    use SoftDeletes;

    protected $table = "orders";
    protected $primaryKey = "id";

    protected $fillable = [
    	'product_id' ,
        'user_id' ,
        'responsible_user_id' ,
        'number' ,
        'address' ,
        'village' ,
        'district' ,
        'regence' ,
        'province' ,
        'post_code' ,
        'price_total' ,
        'discount_total' , 
        'grand_total' ,
        'qty' ,
        'date' ,
        'desc' ,
        'slug' ,
        'status' ,
        'created_at' ,
        'updated_at' ,
        'delete_at',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    public function product()
    {
        return $this->belongsTo(Product::class, 'product_id', 'id');
    }

    public function province()
    {
        return $this->belongsTo(Location::class, 'order_province_id', 'location_id');
    }

    public function regency()
    {
        return $this->belongsTo(Location::class, 'order_regency_id', 'location_id');
    }

    public function district()
    {
        return $this->belongsTo(Location::class, 'order_district_id', 'location_id');
    }

    public function village()
    {
        return $this->belongsTo(Location::class, 'order_village_id', 'location_id');
    }
}
