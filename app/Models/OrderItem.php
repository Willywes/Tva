<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class OrderItem extends Model
{
    protected $fillable = [
        'id',
        'order_id',
        'product_id',
        'quantity',
        'price',
        'product_attributes',
        'extra_price',
        'extra_description',
        'subtotal',
        'created_at,',
        'updated_at,'
    ];

    protected $appends = ['order_item_attributes'];

    public function order(){
        return $this->belongsTo(Order::class);
    }

    public function product(){
        return $this->belongsTo(Product::class);
    }

    public function getOrderItemAttributesAttribute(){
        if($this->product_attributes){
            return ProductAttribute::with('attribute.attribute_category')->findMany(json_decode($this->product_attributes));
        }
        return null;
    }
}
