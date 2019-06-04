<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class OrderStatus extends Model
{
    protected $fillable = [
        'id',
        'name',
        'background',
        'color',
        'created_at',
        'updated_at'
    ];
}
