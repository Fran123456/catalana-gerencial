<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Container extends Model
{
    use HasFactory;

    public $timestamps = false;

    protected $fillable = [
        'id',
        'title',
        'active',
        'code',
        'created_at'
    ];

    public function subcontainers(){
        return $this->hasMany(Subcontainer::class);
    }

    public function archives(){
        return $this->hasMany(Archive::class);
    }

    public function histories(){
        return $this->hasMany(History::class);
    }
}
