<?php

namespace App\Scope;


use Illuminate\Database\Eloquent\Scope;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;

class ShopScope implements Scope
{
    public function apply(Builder $builder, Model $model)
    {
        if (auth()->check()) {
            if (!auth()->guard('customer')->check()) {
                $builder->where('shop_id', auth()->user()->shop_id);
            }
        }


    }
}