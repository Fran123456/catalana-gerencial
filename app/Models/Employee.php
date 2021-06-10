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

    public function enterprise(){
        return $this->belongsTo(Enterprise::class);
    }

    public function area(){
        return $this->belongsTo(Area::class);
    }

    public function department(){
        return $this->belongsTo(Department::class);
    }

    public function position(){
        return $this->belongsTo(Position::class);
    }

    public function publicationEmployee(){
        return $this->hasMany(PublicationEmployee::class);
    }

    public function trainingEmployee(){
        return $this->hasMany(TrainingEmployee::class);
    }

    public function histories(){
        return $this->hasMany(History::class);
    }
}
