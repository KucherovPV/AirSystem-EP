<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Flight extends Model
{
    use HasFactory;

    protected $table = 'flight';
    protected $fillable = [
        'number_flight_airline',
        'status_is_flight',
        'status_is_over',
        'duration',
        'boarding_time',
        'takeoff_time',
        'fk_board',
        'fk_airport_where',
        'fk_airport_whither',
        'fk_airline',
        'fk_type_of_flight'
    ];
}
