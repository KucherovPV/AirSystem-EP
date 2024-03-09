<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Airline extends Model
{
    use HasFactory;
    protected $table = 'airline';
    protected $primaryKey = 'code_iata';
    public $incrementing = false;
    protected $fillable = [
        'code_iata',
        'code_icao',
        'name',
        'country',
        'locale_code',
    ];
}
