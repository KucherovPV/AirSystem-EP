<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Delay extends Model
{
    use HasFactory;

    protected $table = 'delay';
    protected $fillable = [
            'approximate_time',
            'fk_airport',
            'fk_flight',
            'fk_reason_status',
            'fk_reason_change'
        ];

    public function changeReason()
    {
        return $this->belongsTo(ReasonChange::class, 'fk_reason_change');
    }
    public function categoryType()
    {
        return $this->belongsTo(TypeCategory::class, 'fk_reason_status');
    }
    public function flight()
    {
        return $this->belongsTo(Flight::class, 'fk_flight');
    }
}
