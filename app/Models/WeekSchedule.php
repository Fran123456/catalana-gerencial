<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class WeekSchedule extends Model
{
    use HasFactory;

    public $timestamps = false;

    protected $fillable = [
        'id',
        'day',
        'exit_time',
        'entry_time',
        'break',
        'lunch',
        'day_name',
        'schedule_id',
    ];    
}
