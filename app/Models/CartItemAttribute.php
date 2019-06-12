<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CartItemAttribute extends Model
{
    protected $fillable = [
        'id',
        'cart_item_id',
        'product_attribute_id',
        'created_at',
        'updated_at'
    ];

    public function cart(){
        return $this->belongsTo(Cart::class);
    }

    public function product_attribute(){
        return $this->hasOne(ProductAttribute::class);
    }
}
