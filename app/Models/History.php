<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class History extends Model
{
    use HasFactory;

    public $timestamps = false;

    protected $fillable = [
        'id',
        'container_id',
        'subcontainer_id',
        'archive_id',
        'employee_id',
        'archive_type_id',
        'date'            
    ];

    public function container(){
        return $this->belongsTo(Container::class);
    }

    public function subcontainer(){
        return $this->belongsTo(Subcontainer::class);
    }

    public function archive(){
        return $this->belongsTo(Archive::class);
    }

    public function archiveType(){
        return $this->belongsTo(ArchiveType::class);
    }

    public function employee(){
        return $this->belongsTo(Employee::class);
    }
    
}
