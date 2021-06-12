<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Archive;
use App\Models\SubContainer;

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

   //extra
   public function activeFile($container){
    $arc = Archive::where('subcontainer_id', $container)->where('active', true)->first();
    return $arc;
  }

  public function next($subcontainer){
    return SubContainer::where('back', $subcontainer)->first();
  }

  public function  back($subcontainer){
     return SubContainer::find($subcontainer);
  }

}
