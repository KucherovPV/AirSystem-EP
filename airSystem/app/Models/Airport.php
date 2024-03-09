<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Airport extends Model
{
    use HasFactory;

    protected $table = 'airport';
    protected $primaryKey = 'code_iata';
    public $incrementing = false;
    protected $fillable = [
        'code_iata',
        'code_icao',
        'name',
        'coordinates',
        'city',
        'country'
    ];

}
