<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Training extends Model
{
    use HasFactory;    

    public $timestamps = false;

    protected $fillable = [
        'id',
        'training',
        'type',
        'start_date',
        'end_date',
        'hour',
        'year',
    ];

    public function trainingEmployee(){
        return $this->hasMany(TrainingEmployee::class);
    }

}
