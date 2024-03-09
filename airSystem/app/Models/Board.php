<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Board extends Model
{
    use HasFactory;

    protected $table = 'board';
    protected $primaryKey = 'board_code';
    public $incrementing = false;
    protected $fillable = [
        'board_code',
        'name',
        'country',
        'manufacturer',
        'fk_board_type',
    ];

    public function typeCategory()
    {
        return $this->belongsTo(TypeCategory::class, 'fk_board_type');
    }
}
