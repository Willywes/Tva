<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProductAttribute extends Model
{
    protected $fillable = [
        'attribute_id',
        'product_id',
        'created_at',
        'updated_at'
    ];
}
