<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Schedule extends Model
{
    use HasFactory;
    protected $table = 'schedules';

    protected $guarded = false;

    public function days()
    {
        return $this->belongsToMany(Days::class,'days_schedules','schedule_id','day_id');
    }
    public function flight()
    {
        return $this->belongsTo(Flight::class,'flight_number','flight_number','flights');
    }

}
