<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\Relation;
use Illuminate\Database\Eloquent\SoftDeletes;

class Delay extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'delays';
    protected $guarded = false;

    public function categoryType(): Relation
    {
        return $this->belongsTo(TypeCategory::class, 'reason_type_id');
    }
    public function flight(): Relation
    {
        return $this->belongsTo(Flight::class, 'flight_number');
    }
    public function airport(): Relation
    {
        return $this->belongsTo(Airport::class, 'airport_code');
    }
}
