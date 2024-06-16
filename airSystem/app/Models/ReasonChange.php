<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ReasonChange extends Model
{
    use HasFactory, SoftDeletes;
    protected $table = 'reason_changes';
    protected $guarded = false;
}
