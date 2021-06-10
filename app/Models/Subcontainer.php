<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Subcontainer extends Model
{
    use HasFactory;

    public $timestamps = false;

    protected $fillable=[
        'id',
        'title',
        'order',
        'back',
        'code',
        'container_id',
        'created_at'
    ];

    public function container(){
        return $this->belongsTo(Container::class);
    }

    public function archives(){
        return $this->hasMany(Archive::class);
    }

    public function histories(){
        return $this->hasMany(History::class);
    }
}