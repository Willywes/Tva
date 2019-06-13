<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Shop extends Model
{
    protected $fillable = [
        'id',
        'logo',
        'rut',
        'business_name',
        'shop_name',
        'shop_description',
        'address',
        'shop_phone_one',
        'shop_phone_two',
        'shop_email',
        'taxes',
        'tax_value',
        'tax_included_price',
        'created_at',
        'updated_at'
    ];
}