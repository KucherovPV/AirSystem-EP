<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\Relation;
use Illuminate\Database\Eloquent\SoftDeletes;

class Flight extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'flights';
    protected $primaryKey = 'flight_number';
    public $incrementing = false;
    protected $guarded = false;

    public function board(): Relation
    {
        return $this->belongsTo(Board::class, 'board_code', 'board_code', 'boards');
    }

    public function airportWhither(): Relation
    {
        return $this->belongsTo(Airport::class, 'airport_code_whither', 'code_iata', 'airports');
    }

    public function airportWhere(): Relation
    {
        return $this->belongsTo(Airport::class, 'airport_code_where', 'code_iata', 'airports');
    }

    public function airline(): Relation
    {
        return $this->belongsTo(Airline::class, 'airline_code', 'code_iata', 'airlines');
    }

    public function type(): Relation
    {
        return $this->belongsTo(TypeCategory::class, 'flight_type_id', 'id', 'type_categories');
    }

}
