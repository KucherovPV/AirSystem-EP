<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class AircraftModel extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'aircraft_models';
    protected $guarded = false;

    public function manufacturer()
    {
        return $this->belongsTo(Manufacturer::class, 'manufacturer_id','id', 'manufacturers');
    }
}
