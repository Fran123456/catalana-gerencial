<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


use App\Models\Archive;
use App\Models\ArchiveType;
use App\Models\Area;
use App\Models\Container;
use App\Models\Department;
use App\Models\Employee;
use App\Models\Enterprise;
use App\Models\History;
use App\Models\Position;
use App\Models\Publication;
use App\Models\PublicationEmployee;
use App\Models\Subcontainer;
use App\Models\Suggestion;
use App\Models\SuggestionType;
use App\Models\Training;
use App\Models\TrainingEmployee;
use App\Models\TrainingType;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Date;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;


class LogDB extends Model
{
    use HasFactory;
      protected $table = 'log_db';
    protected $fillable = [
        'id',
        'log',
    ];
}
