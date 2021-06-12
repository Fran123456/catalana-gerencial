<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Archive;
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

    public function activeFile($type){
      $archivos = Archive::where('archive_type_id', $type)->where('active', 1)->get();
      return $archivos;
      //return $this->hasMany(ISOArchivo::class,'tipo_archivo_id');
    }

}
