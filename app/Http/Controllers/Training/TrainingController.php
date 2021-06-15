<?php

namespace App\Http\Controllers\Training;

use App\Exports\Trainings\Tactical\Books\TrainingR4_Export_Book;
use App\Exports\Trainings\Tactical\Books\TrainingR5_Export_Book;
use App\Exports\Trainings\Tactical\Books\TrainingR6_Export_Book;
use App\Exports\Trainings\Tactical\Books\TrainingR1_Export_Book;
use App\Exports\Trainings\Tactical\Books\TrainingR2_Export_Book;
use App\Exports\Trainings\Tactical\Books\TrainingR3_Export_Book;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Help\Help;
use App\Models\Enterprise;
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
    ini_set('memory_limit', '1G');

    $this->middleware('auth');
  }


  public function home(){
    $help = new Help();
    $trainings = Training::all();
    return view ('training.home',compact('help','trainings'));
  }


 //report training scorebytraining = strategic
 public function r1_($type , $yeari, $yearf){
  if(Auth::user()->hasPermissionTo('trainings_estrategic')){
    $total=$yearf-$yeari;
   $trainingsArray=array();
   if($total==0){
     $trainingsArray[0]=Training::where('year', $yearf)->get();
   }else {
     $years = array();
     for ($i=0; $i <=$total ; $i++) {
       //array_push($years, $yeari+$i);
       $aux=Training::where('year', $yeari+$i)->get();
       array_push($trainingsArray, $aux);
     }
   }

   $scores=array();
   for ($i=0; $i < count($trainingsArray); $i++) {
     for ($y=0; $y <count($trainingsArray[$i]) ; $y++) {
         $t= TrainingEmployee::where('training_id', $trainingsArray[$i][$y]['id'])->get();
         $score=0;
         foreach ($t as $key => $value) {
           $score= $value->score!=null?$score=$value->score+$score:$score=$score;
         }
         $score=$score/count($t);
         $aux=array([
           'id'=> $trainingsArray[$i][$y]['id'],
           'training'=>$trainingsArray[$i][$y]['training'],
           'year'=>$trainingsArray[$i][$y]['year'],
           'score'=> $score
         ]);
         array_push($scores, $aux[0]);
     }
   }

   activity('Generación de reporte estratégico')
    ->by(Auth::user())
    ->log('El usuario '.Auth::user()->name.' generó el reporte de promedio de notas por capacitación por periodo del módulo de capacitaciones.');

   if($type == 'pdf'){
     $pdf = PDF::loadView('pdf-reports.capacitaciones.r1-estrategico', compact('scores','yeari','yearf'));
     return $pdf->stream('Modulo_capacitaciones_promedio_notas_por_capacitacion.pdf');
   }
   elseif ($type == 'excel') {
     return \Excel::download(new TrainingR1_Export_Book($scores),'Modulo_capacitaciones_promedio_notas_por_capacitacion.xlsx');
   }   
  }
  else{
    activity('Acceso denegado')
    ->by(Auth::user())
    ->log('El usuario '.Auth::user()->name.' intentó generar el reporte de promedio de notas por capacitación por periodo del módulo de capacitaciones.');
    abort(403,__('Unauthorized'));
  }
   
 }
 //report training number of quiz answered and not answered by year
 public function r2_($type , $yeari, $yearf){
  if(Auth::user()->hasPermissionTo('trainings_estrategic')){
    $data =  Training::join('training_employees','training_employees.training_id','trainings.id')
            ->whereBetween('trainings.year',[$yeari,$yearf])
            ->select('trainings.year','trainings.id','trainings.training as capacitacion', DB::raw('COUNT(trainings.training) AS total') ,  DB::raw('COUNT( taken= '.'"si"'.') realizados') )
            ->groupBy('trainings.id','trainings.training','trainings.year')
            ->orderBy('trainings.year')
            ->get();

      activity('Generación de reporte estratégico')
      ->by(Auth::user())
      ->log('El usuario '.Auth::user()->name.' generó el reporte de estadísticas de capacitaciones por periodo del módulo de capacitaciones.');

    if($type == 'pdf'){
        $pdf = PDF::loadView('pdf-reports.capacitaciones.r2-estrategico-pdf', compact('data','yeari','yearf'));
        return $pdf->download('Periodo_'.$yeari.'--'.$yearf.'_Modulo_capacitaciones_cuestionarios_respondidos_y_no_respondidos.pdf');
      }
      elseif ($type == 'excel') {
        return \Excel::download(new TrainingR2_Export_Book($data, $yeari, $yearf),'Periodo_'.$yeari.'--'.$yearf.'_Modulo_capacitaciones_cuestionarios_respondidos_y_no_respondidos.xlsx');
      }
  }
  else{
    activity('Acceso denegado')
    ->by(Auth::user())
    ->log('El usuario '.Auth::user()->name.' intentó generar el reporte de estadísticas de capacitaciones por periodo del módulo de capacitaciones.');
    abort(403,__('Unauthorized'));
  }
    
 }


 public function r3_($type , $yeari, $yearf){
    if(Auth::user()->hasPermissionTo('trainings_estrategic')){
        $data =  Training::join('training_employees','training_employees.training_id','trainings.id')
        ->whereBetween('trainings.year',[$yeari,$yearf])
        ->select('trainings.year','trainings.id','trainings.training as capacitacion' )
        ->groupBy('trainings.id','trainings.training','trainings.year')
        ->orderBy('trainings.year')
        ->get();

        activity('Generación de reporte estratégico')
        ->by(Auth::user())
        ->log('El usuario '.Auth::user()->name.' generó el reporte de capacitaciones realizadas por periodo del módulo de capacitaciones.');

        if($type == 'pdf'){
        $pdf = PDF::loadView('pdf-reports.capacitaciones.r3-estrategico-pdf', compact('data','yeari','yearf'));
        return $pdf->download('Periodo_'.$yeari.'--'.$yearf.'_Modulo_capacitaciones_realizadas.pdf');
        }
        elseif ($type == 'excel') {
        return \Excel::download(new TrainingR3_Export_Book($data, $yeari, $yearf),'Periodo_'.$yeari.'--'.$yearf.'_Modulo_capacitaciones_realizadas.xlsx');
        }
    }
    else{
      activity('Acceso denegado')
      ->by(Auth::user())
      ->log('El usuario '.Auth::user()->name.' intentó generar el reporte de capacitaciones realizadas por periodo del módulo de capacitaciones.');
      abort(403,__('Unauthorized'));
     
 }


 //---------------REPORTES TÁCTICOS----------------------
 //reporte de empleados que resuelve y no una capacitacion
 public function r4_($type, $trainingId){
  if(Auth::user()->hasPermissionTo('trainings_tactical')){
        $query = '';
        $text = 'Modulo_Capacitaciones_Empleados_que_resuelven_y_no_resuelven_capacitación';
        $tipo = '';
        $tomados = [];
        $no_tomados = [];

        if($trainingId == 0){//flujo cuando son todos los tipos los requeridos
          $tipo = "TODAS";
          $text = $text."_Todos";
          $query = Training::all();
          foreach($query as $key => $training){
            $submitted = TrainingEmployee::where('training_id','=',$training->id)
                          ->where('taken','=','si')
                          ->with('employee','employee.enterprise','employee.area','employee.department','employee.position')
                          ->get();
          array_push($tomados,$submitted);
          $unsubmitted = TrainingEmployee::where('training_id','=',$training->id)
                          ->whereNull('taken')
                          ->with('employee','employee.enterprise','employee.area','employee.department','employee.position')
                          ->get();
          array_push($no_tomados,$unsubmitted);
          }
        }
        else{//flujo cuando se especifica de qué tipo se quiere
          $tipo = Training::where('id','=',$trainingId)->get()->first();
          $text = $text."_".$tipo->training;
          $query = Training::where('id','=',$trainingId)->get();
          $submitted = TrainingEmployee::where('training_id','=',$trainingId)
                          ->where('taken','=','si')
                          ->with('employee','employee.enterprise','employee.area','employee.department','employee.position')
                          ->get();
          array_push($tomados,$submitted);
          $unsubmitted = TrainingEmployee::where('training_id','=',$trainingId)
                          ->whereNull('taken')
                          ->with('employee','employee.enterprise','employee.area','employee.department','employee.position')
                          ->get();
          array_push($no_tomados,$unsubmitted);
        }

        activity('Generación de reporte táctico')
        ->by(Auth::user())
        ->log('El usuario '.Auth::user()->name.' generó el reporte de empleados que resuelven y no una capacitación del módulo de capacitaciones.');

        if($type == 'pdf'){
          $pdf = PDF::loadView('pdf-reports.capacitaciones.r4-tactico', compact('query','text','tipo','tomados','no_tomados'));
          return $pdf->setPaper('A4','landscape')->stream($text.'.pdf');
        }
        elseif ($type == 'excel') {
          return Excel::download(new TrainingR4_Export_Book($query,$text,$tipo,$tomados,$no_tomados),$text.'.xlsx');
        }
  }
  else{
    activity('Acceso denegado')
    ->by(Auth::user())
    ->log('El usuario '.Auth::user()->name.' intentó generar el reporte de empleados que resuelven y no una capacitación del módulo de capacitaciones.');
    abort(403,__('Unauthorized'));
  }
 }

 //Reporte de lista de notas de empleados aprobados y reprobados por capacitación
 public function r5_($type, $trainingId){
  if(Auth::user()->hasPermissionTo('trainings_tactical')){
      $query = '';
      $text = 'Modulo_Capacitaciones';
      $tipo = '';
      $aprobados = [];
      $reprobados = [];
      $sin_nota = [];

      if($trainingId == 0){//flujo cuando son todos los tipos los requeridos
        $tipo = "TODAS";
          $text = $text."_Todos";
          $query = Training::all();
          foreach($query as $key => $training){
            $approved = TrainingEmployee::where('training_id','=',$training->id)
                          ->where('score','>=','8')
                          ->whereNotNull('score')
                          ->with('employee')
                          ->get();
          array_push($aprobados,$approved);
          $failed = TrainingEmployee::where('training_id','=',$training->id)
                          ->where('score','<','8')
                          ->whereNotNull('score')
                          ->with('employee')
                          ->get();
          array_push($reprobados,$failed);
          $none = TrainingEmployee::where('training_id','=',$training->id)
                            ->whereNull('score')
                            ->with('employee')
                            ->get();
          array_push($sin_nota,$none);
          }
      }
      else{
        $tipo = Training::where('id','=',$trainingId)->get()->first();
        $text = $text."_".$tipo->training;
        $query = Training::where('id','=',$trainingId)->get();
        $approved = TrainingEmployee::where('training_id','=',$trainingId)
                          ->where('score','>=','8')
                          ->whereNotNull('score')
                          ->with('employee')
                          ->get();
          array_push($aprobados,$approved);
          $failed = TrainingEmployee::where('training_id','=',$trainingId)
                          ->where('score','<','8')
                          ->whereNotNull('score')
                          ->with('employee')
                          ->get();
          array_push($reprobados,$failed);
          $none = TrainingEmployee::where('training_id','=',$trainingId)
                            ->whereNull('score')
                            ->with('employee')
                            ->get();
          array_push($sin_nota,$none);
      }

      $text = $text."_aprobados_y_reprobados";

      activity('Generación de reporte táctico')
      ->by(Auth::user())
      ->log('El usuario '.Auth::user()->name.' generó el reporte de lista de notas de empleados aprobados y reprobados por capacitación del módulo de capacitaciones.');

      if($type == 'pdf'){
        $pdf = PDF::loadView('pdf-reports.capacitaciones.r5-tactico', compact('query','text','tipo','aprobados','reprobados','sin_nota'));
        return $pdf->setPaper('A4','landscape')->stream($text.'.pdf');
      }

      elseif ($type == 'excel') {
        return Excel::download(new TrainingR5_Export_Book($query,$text,$tipo,$aprobados,$reprobados,$sin_nota),$text.'.xlsx');
      }
  }
  else{
    activity('Acceso denegado')
    ->by(Auth::user())
    ->log('El usuario '.Auth::user()->name.' intentó generar el reporte de lista de notas de empleados aprobados y reprobados por capacitación del módulo de capacitaciones.');
    abort(403,__('Unauthorized'));
  }
 }

 //Reporte de todos los empleados de una capacitación
 public function r6_($type, $trainingId){
  if(Auth::user()->hasPermissionTo('trainings_tactical')){
      $query = '';
      $text = 'Modulo_Capacitaciones';
      $tipo = '';
      $empleados = [];

      if($trainingId == 0){//flujo cuando son todos los tipos los requeridos
        $tipo = "TODAS";
          $text = $text."_Todas_Capacitaciones";
          $query = Training::all();
          foreach($query as $key => $training){
            $employees = DB::table('training_employees')
                    ->join('employees','training_employees.employee_id','=','employees.id')
                    ->join('enterprises','employees.enterprise_id','=','enterprises.id')
                    ->join('areas','employees.area_id','=','areas.id')
                    ->join('departments','employees.department_id','=','departments.id')
                    ->join('positions','employees.position_id','=','positions.id')
                    ->where('training_employees.training_id','=',$training->id)
                    ->select('employees.id as id','employees.names as name','employees.lastnames as lastname','enterprises.enterprise as enterprise','areas.area as area','departments.department as department','positions.position as position')
                    ->get();

          array_push($empleados,$employees);
          }
      }
      else{
        $tipo = Training::where('id','=',$trainingId)->get()->first();
        $text = $text."_".$tipo->training;
        $query = Training::where('id','=',$trainingId)->get();

        $employees = DB::table('training_employees')
                          ->join('employees','training_employees.employee_id','=','employees.id')
                          ->join('enterprises','employees.enterprise_id','=','enterprises.id')
                          ->join('areas','employees.area_id','=','areas.id')
                          ->join('departments','employees.department_id','=','departments.id')
                          ->join('positions','employees.position_id','=','positions.id')
                          ->where('training_employees.training_id','=',$trainingId)
                          ->select('employees.id as id','employees.names as name','employees.lastnames as lastname','enterprises.enterprise as enterprise','areas.area as area','departments.department as department','positions.position as position')
                          ->get();
        array_push($empleados,$employees);
      }

      $text = $text."_todos_empleados_asignados";

      activity('Generación de reporte táctico')
      ->by(Auth::user())
      ->log('El usuario '.Auth::user()->name.' generó el reporte de todos los empleados de una capacitación del módulo de capacitaciones.');

      if($type == 'pdf'){
        $pdf = PDF::loadView('pdf-reports.capacitaciones.r6-tactico', compact('query','text','tipo','empleados'));
        return $pdf->setPaper('A4','landscape')->stream($text.'.pdf');
      }
      elseif ($type == 'excel') {
        return Excel::download(new TrainingR6_Export_Book($query,$text,$tipo,$empleados),$text.'.xlsx');
      }
  }
  else{
    activity('Acceso denegado')
    ->by(Auth::user())
    ->log('El usuario '.Auth::user()->name.' intentó generar el reporte de todos los empleados de una capacitación del módulo de capacitaciones.');    
    abort(403,__('Unauthorized'));    
  }
}
}
