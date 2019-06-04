<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Attribute extends Model
{
    protected $fillable = [
        'id',
        'name',
        'type',
        'attribute_category_id',
        'created_at',
        'updated_at'
    ];

    public function attribute_category(){
        return $this->belongsTo(AttributeCategory::class);
    }

    public function products(){
        return $this->belongsToMany(Product::class,'product_attributes','attribute_id','product_id');
    }
}
