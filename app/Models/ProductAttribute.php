<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProductAttribute extends Model
{
    protected $fillable = [
        'id',
        'price',
        'attribute_id',
        'product_id',
        'created_at',
        'updated_at'
    ];

//    public function products(){
//        return $this->belongsTo(Product::class );
//    }
    public function attribute(){
        return $this->belongsTo(Attribute::class );
    }
}
