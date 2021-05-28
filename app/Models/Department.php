<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Department extends Model
{
    use HasFactory;

    protected $fillable = [
        'id',
        'department',
        'area_id'
    ];

    public function area(){
        return $this->belongsTo(Area::class);
    }

    public function positions(){
        return $this->hasMany(Position::class);
    }

    public function employees(){
        return $this->hasMany(Employee::class);
    }
}
