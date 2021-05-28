<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Employee extends Model
{
    use HasFactory;

    public $timestamps = false;

    protected $fillable = [
        'id',        
        'names',
        'lastnames',
        'dui',
        'nit',
        'isss',
        'department_id',
        'enterprise_id',
        'area_id',
        'position_id',
        'enabled',
        'coordinator',
        'boss_list',
    ];
}
