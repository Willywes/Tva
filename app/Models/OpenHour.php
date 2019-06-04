<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class OpenHour extends Model
{
    protected $fillable = [
        'id',
        'start',
        'end',
        'timetable_id',
        'created_at',
        'updated_at'
    ];
}
