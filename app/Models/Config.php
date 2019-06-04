<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Config extends Model
{
    protected $table = 'configs';

    protected $fillable = [
        'id',
        'store_name',
        'store_description',
        'address',
        'store_phone_one',
        'store_phone_two',
        'store_email',
        'taxes',
        'tax_value',
        'tax_included_price',
        'created_at',
        'updated_at'
    ];

    public function scopeStoreName()
    {
        return $this->select('value')->where('name', 'LIKE', 'store_name')->first();
    }
}
