<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Suggestion extends Model
{
    use HasFactory;

    public $timestamps = false;

    protected $fillable = [
        'id',
        'suggestion',
        'suggestion_type_id',
        'suggestion_type',
        'date',
        'reading',
        'employee_id',
    ];
}
