<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Airline extends Model
{
    use HasFactory, SoftDeletes;
    protected $table = 'airlines';
    protected $primaryKey = 'code_iata';
    public $incrementing = false;
    protected $guarded = false;

    public function country()
    {
        return $this->belongsTo(Country::class, 'country_id', 'id','countries');
    }
}
