<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CartItem extends Model
{
    protected $fillable = [
        'id',
        'cart_id',
        'product_id',
        'quantity',
        'created_at,',
        'updated_at,'
    ];

    protected $appends = ['total'];

    public function cart(){
        return $this->belongsTo(Cart::class);
    }

    public function product(){
        return $this->belongsTo(Product::class);
    }

    function getTotalAttribute()
    {
        $total = 0;

        if ($this->product) {
            if($this->product->offer_price){
                $total = $this->product->offer_price * $this->quantity;
            }else{
                $total = $this->product->price * $this->quantity;
            }

        }
        return $total;
    }
}
