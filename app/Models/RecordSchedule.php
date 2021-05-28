<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RecordSchedule extends Model
{
    use HasFactory;

    public $timestamps = false;

    protected $fillable = [
        'id',
        'employee_id',
        'date',
        'schedule',
        'entry_time',
        'exit_time',
        'clock_in',
        'clock_out',
        'delayed_time',
        'early_time',
        'after_hours',
        'worked_time',
        'labor',
        'schedule_id',
    ];
}