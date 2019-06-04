<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $fillable = [
        'id',
        'image',
        'name',
        'slug',
        'description',
        'sku',
        'price',
        'offer_price',
        'weight',
        'length',
        'height',
        'width',
        'product_category_id',
        'position',
        'outstanding',
        'active',
        'editable',
        'removable',
        'created_at',
        'updated_at'
    ];

    protected $attributes = [
        'product_category_id' => 1,
    ];

    protected $appends = [
        'attributes'
    ];

    public function scopeAvailable()
    {
        return $this->where('active', true);
    }

    public function product_category()
    {
        return $this->belongsTo(ProductCategory::class);
    }

    public function attributes()
    {
        return $this->belongsToMany(Attribute::class, 'product_attributes', 'product_id', 'attribute_id');
    }

    function getAttributesAttribute()
    {
        $cat = AttributeCategory::select('id')->whereHas('attributes', function ($attribute) {
            $attribute->whereHas('products', function ($p) {
                $p->where('product_id', $this->id);
            });
        })->get();

        $cat;
        return AttributeCategory::whereHas('attributes')
            ->with(['attributes' => function ($attribute) {
                $attribute->whereHas('products', function ($p) {
                    $p->where('product_id', $this->id);
                });
            }])->find($cat);
    }

}
