<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ArchiveType extends Model
{
    use HasFactory;

    public $timestamps = false;

    protected $fillable = [
        'id',
        'type',
        'code'
    ];

    public function archives(){
        return $this->hasMany(Archive::class);    
    }

    public function histories(){
        return $this->hasMany(History::class);
    }
}
