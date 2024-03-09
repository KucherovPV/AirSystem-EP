<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ReasonChange extends Model
{
    use HasFactory;
    protected $table = 'reason_change';
    protected $fillable = [
        'name',
        'measure_taken',
        'influencing_factor',
        'reason_category'];
}
