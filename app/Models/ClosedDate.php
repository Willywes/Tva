<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ClosedDate extends Model
{
    protected $fillable = [
        'id',
        'date',
        'created_at',
        'updated_at'
    ];
}
