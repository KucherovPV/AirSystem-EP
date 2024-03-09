<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TypeCategory extends Model
{
    use HasFactory;

    protected $table = 'type_category';
    protected $fillable = [
        'name',
        'is_reason_category',
        'is_flight_type',
        'is_board_type',
        'is_reason_status',
    ];
}
