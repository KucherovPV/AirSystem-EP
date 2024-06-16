<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Airport extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'airports';
    protected $primaryKey = 'code_iata';
    public $incrementing = false;
    protected $guarded = false;


    public function city()
    {
        return $this->belongsTo(City::class, 'city_id', 'id','cites');
    }

}
