<?php

namespace App\Models;

use App\Scope\ShopScope;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class ProductCategory extends Model
{
    protected $fillable = [
        'id',
        'image',
        'name',
        'slug',
        'description',
        'parent',
        'position',
        'active',
        'editable',
        'removable',
        'created_at',
        'updated_at'
    ];

//    public function setSlugAttribute($value)
//    {
//        $this->attributes['slug'] = Str::slug($this->attributes['name']);
//    }


    public function children(){
        return $this->hasMany(ProductCategory::class, 'parent', 'id');
    }

    public function scopePositions(){
        return $this->orderBy('position');
    }

    public function scopeParents(){
        return $this->where('parent', null)->orWhere('parent', '==', 0);
    }

    public function scopeAvailable(){
        return $this->where('active', true);
    }

    public function products(){
        return $this->hasMany(Product::class);
    }

    protected static function boot()
    {
        parent::boot();

        static::addGlobalScope(new ShopScope());
    }
}
