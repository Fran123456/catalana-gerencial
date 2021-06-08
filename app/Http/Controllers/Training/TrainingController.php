<?php

namespace App\Http\Controllers\Training;

use App\Exports\Trainings\TrainingR4_Export;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Help\Help;
use App\Models\Training;
use App\Models\TrainingEmployee;
use App\Models\TrainingType;
use Barryvdh\DomPDF\Facade as PDF;
use Maatwebsite\Excel\Facades\Excel;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class TrainingController extends Controller
{
  public function __construct(){
    set_time_limit(8000000);
    $this->middleware('auth');
  }


  public function home(){
    $help = new Help();
    $trainings = Training::all();    
    return view ('training.home',compact('help','trainings'));
  }


 //report training scorebytraining = strategic
 public function r1_($type , $yeari, $yearf){

 }
 //report training number of quiz answered and not answered
 public function r2_($type , $yeari, $yearf){

 }

 //---------------REPORTES TÁCTICOS----------------------
 //reporte de empleados que resuelve y no una capacitacion
 public function r4_($type, $trainingId){
  if(Auth::user()->hasPermissionTo('trainings_tactical')){
        $query = '';
        $text = 'Modulo_Capacitaciones';      
        $tipo = '';
        $aprobados = [];
        $reprobados = [];

        if($trainingId == 0){//flujo cuando son todos los tipos los requeridos
          $tipo = "TODAS";
          $text = $text."_Todos";
          $query = Training::all();
          foreach($query as $key => $training){
            $submitted = TrainingEmployee::where('training_id','=',$training->id)
                          ->where('taken','=','si')
                          ->with('employee')
                          ->get();
          array_push($aprobados,$submitted);
          $unsubmitted = TrainingEmployee::where('training_id','=',$training->id)
                          ->whereNull('taken')
                          ->with('employee')
                          ->get();
          array_push($reprobados,$unsubmitted);
          }  
        }
        else{//flujo cuando se especifica de qué tipo se quiere
          $tipo = Training::where('id','=',$trainingId)->get()->first();
          $text = $text."_".$tipo->training;
          $query = Training::where('id','=',$trainingId)->get();
          $submitted = TrainingEmployee::where('training_id','=',$trainingId)
                          ->where('taken','=','si')
                          ->with('employee')
                          ->get();
          array_push($aprobados,$submitted);
          $unsubmitted = TrainingEmployee::where('training_id','=',$trainingId)
                          ->whereNull('taken')
                          ->with('employee')
                          ->get();
          array_push($reprobados,$unsubmitted);
        }        
        if($type == 'pdf'){        
          $pdf = PDF::loadView('pdf-reports.capacitaciones.r4-tactico', compact('query','text','tipo','aprobados','reprobados'));
          return $pdf->setPaper('A4','landscape')->stream($text.'.pdf');
        }
        elseif ($type == 'excel') {            
          return Excel::download(new TrainingR4_Export($query,$text,$tipo,$aprobados,$reprobados),$text.'.xlsx');
        }  
  }
  else{
    abort(403,__('Unauthorized'));
  }  
 }

 //Reporte de lista de notas de empleados aprobados y reprobados por capacitación
 public function r5_(){
  if(Auth::user()->hasPermissionTo('trainings_tactical')){

  }
  else{
    abort(403,__('Unauthorized'));
  }
 }

 //Reporte de todos los empleados de una capacitación
 public function r6_(){
  if(Auth::user()->hasPermissionTo('trainings_tactical')){

  }
  else{
    abort(403,__('Unauthorized'));
  }
}


}
