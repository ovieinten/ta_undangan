<?php

namespace App\Models;

use App\User;
use App\Models\Order;
use App\Models\Payment;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


class Sale extends Model
{
    use SoftDeletes;

    protected $table = "sales";
    protected $primaryKey = "id";

    protected $fillable = [
        'order_id' ,
        'payment_id' ,
        'paid_total' ,
        'created_at' ,
        'updated_at' ,
        'delete_at',
    ];

    public function order()
    {
        return $this->belongsTo(Order::class, 'order_id', 'id');
    }

    public function payment()
    {
        return $this->belongsTo(Payment::class, 'payment_id', 'id');
    }
}
