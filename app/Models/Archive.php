<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Archive extends Model
{
    use HasFactory;

    public $timestamps = false;

    protected $fillable = [
        'id',
        'title',
        'version',
        'edition',
        'active',
        'download_mark',
        'download',
        'format',
        'container_id',
        'subcontainer_id',
        'archive_type_id',
        'code',
        'created_at'
    ];

    public function container(){
        return $this->belongsTo(Container::class);
    }

    public function subcontainer(){
        return $this->belongsTo(Subcontainer::class);
    }

    public function archiveType(){
        return $this->belongsTo(ArchiveType::class);
    }

    public function histories(){
        return $this->hasMany(History::class);
    }
}
