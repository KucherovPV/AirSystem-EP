<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Board extends Model
{
    use HasFactory , SoftDeletes;

    protected $table = 'boards';
    protected $primaryKey = 'board_code';
    public $incrementing = false;
    protected $guarded = false;

    public function type()
    {
        return $this->belongsTo(TypeCategory::class, 'board_type_id','id','type_categories');
    }
    public function airline()
    {
        return $this->belongsTo(Airline::class, 'airline_code','code_iata','airlines');
    }
    public function model()
    {
        return $this->belongsTo(AircraftModel::class, 'model_id','id','aircraft_models');
    }
}
