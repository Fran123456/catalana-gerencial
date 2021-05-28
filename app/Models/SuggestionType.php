<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SuggestionType extends Model
{
    use HasFactory;

    public $timestamps = false;

    protected $fillable = [
        'id',        
        'suggestion_type',
        'status',        
    ];
}
