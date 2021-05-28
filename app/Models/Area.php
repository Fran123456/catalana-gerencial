<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Area extends Model
{
    use HasFactory;

    protected $fillable = [
        'id',
        'area',
        'enterprise_id'
    ];

    public function enterprise(){
        return $this->belongsTo(Enterprise::class);
    }

    public function departments(){
        return $this->hasMany(Department::class);
    }
    
    public function employees(){
        return $this->hasMany(Employee::class);
    }
}
