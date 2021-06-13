<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Publication extends Model
{
    use HasFactory;

    public $timestamps = false;

    protected $fillable = [
        'id',
        'title',
        'type',
        'date',
        'year'
    ];

    public function empleados(): BelongsToMany
    {
        return $this->belongsToMany(
            Employee::class,
            'publication_employees',
            'publication_id',
            'employee_id'
        )->withPivot('seen')->as('detalle');
    }
}
