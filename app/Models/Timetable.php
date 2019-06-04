<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Timetable extends Model
{
    protected $fillable = [
        'id',
        'day',
        'key_day',
        'created_at',
        'updated_at'
    ];

    public function open_hours(){
        return $this->hasMany(OpenHour::class);
    }
}
