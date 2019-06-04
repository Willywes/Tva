<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $fillable = [
        'id',
        'customer_id',
        'wasabi',
        'ginger',
        'sticks',
        'sticks_quantity',
        'subtotal',
        'dispatch_amount',
        'total',
        'payment',
        'comments',
        'order_type_id',
        'order_status_id',
        'customer_address_id',
        'created_at',
        'updated_at'
    ];

    public function customer(){
        return $this->belongsTo(Customer::class);
    }


    public function items(){
        return $this->hasMany(OrderItem::class);
    }

    public function address(){
        return $this->belongsTo(CustomerAddress::class, 'customer_address_id');
    }

    public function order_type(){
        return $this->belongsTo(OrderType::class);
    }

    public function order_status(){
        return $this->belongsTo(OrderStatus::class);
    }
}
