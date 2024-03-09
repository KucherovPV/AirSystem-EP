<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BoardingTakeoff extends Model
{
    use HasFactory;

    protected $table = 'boarding_takeoff';

    protected $fillable = [
        'status_completed',
        'action_time',
        'fk_board',
        'boarding',
        'fk_flight',
        'takeoff'
    ];
}
