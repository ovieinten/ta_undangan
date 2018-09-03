<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Location extends Model
{
    use SoftDeletes;

    protected $table = "core_locations";
    protected $primaryKey = "location_id";

    protected $fillable = [
        'location_parent_id',
        'location_name',
        'location_shortname',
        'location_postcode',
        'location_type',
        'location_image',
        'location_latitude',
        'location_longitude',
        'location_created_at',
        'location_updated_at',
        'location_deleted_at',
    ];


    const DELETED_AT = "location_deleted_at";
    const UPDATED_AT = "location_updated_at";
    const CREATED_AT = "location_created_at";

    protected $dates = [
        "location_created_at",
        "location_updated_at",
        "location_deleted_at"
    ];

    public function orderProvinces()
    {
        return $this->hasMany(Order::class, 'order_province_id', 'location_id');
    }

    public function orderRegencies()
    {
        return $this->hasMany(Order::class, 'order_regency_id', 'location_id');
    }

    public function orderDistricts()
    {
        return $this->hasMany(Order::class, 'order_district_id', 'location_id');
    }

    public function orderVillages()
    {
        return $this->hasMany(Order::class, 'order_village_id', 'location_id');
    }
}
