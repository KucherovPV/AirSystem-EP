<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DaysSchedule extends Model
{
    use HasFactory;

    protected $table = 'days_schedules';

    protected $guarded = false;
}
