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

    protected $appends = [
        'price',
        'offer_price',
        'extra_price',
        'total'
    ];

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

            if($this->product_attributes){

                foreach ($this->product_attributes as $product_attribute){
                    if($product_attribute->price){
                        $total += $product_attribute->price * $this->quantity;
                    }
                }
            }
        }
        return $total;
    }

    function getPriceAttribute()
    {
        $price = 0;

        if ($this->product) {
            $price = $this->product->price;

            if(count($this->product_attributes)){
                foreach ($this->product_attributes as $product_attribute){
                    $price += $product_attribute->price;
                }
            }
        }
        return $price;
    }

    function getOfferPriceAttribute()
    {
        $offer_price = 0;

        if ($this->product) {
            if(!$this->product->offer_price){
                return null;
            }
            $offer_price = $this->product->offer_price;

            if(count($this->product_attributes)){
                foreach ($this->product_attributes as $product_attribute){
                    $offer_price += $product_attribute->price;
                }
            }
        }
        return $offer_price;
    }

    function getExtraPriceAttribute()
    {
        $extra_price = 0;

        if ($this->product) {
            if(!$this->product->offer_price){
                return null;
            }

            if(count($this->product_attributes)){
                foreach ($this->product_attributes as $product_attribute){
                    $extra_price += $product_attribute->price;
                }
            }
        }
        return $extra_price;
    }

    public function product_attributes(){
        return $this->belongsToMany(ProductAttribute::class, 'cart_item_attributes', 'cart_item_id', 'product_attribute_id');
    }

    public function cart_item_attributes(){
        return $this->belongsToMany(ProductAttribute::class, 'cart_item_attributes', 'cart_item_id', 'product_attribute_id');
    }

}
