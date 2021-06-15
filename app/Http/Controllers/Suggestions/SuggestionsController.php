<?php

namespace App\Http\Controllers\Suggestions;


use App\Exports\Suggestions\Tactical\Sheets\SuggestionsR2_Export;
use App\Exports\Trainings\Tactical\Books\SugestionStrategic;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\SuggestionType;
use App\Help\Help;
use App\Models\Suggestion;
use Carbon\Carbon;
use Illuminate\Support\Facades\URL;
use Barryvdh\DomPDF\Facade as PDF;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Spatie\Activitylog\Models\Activity;

class SuggestionsController extends Controller
{
    public function __construct(){
      set_time_limit(8000000);
      $this->middleware('auth');
    }

    public function home(){
        $types = SuggestionType::all();
        $help = new Help();
        activity('Visita')
        ->by(Auth::user())
        ->log('El usuario '.Auth::user()->name.' visitó /suggestions/home.');
        return view ('suggestions.home',compact('types','help'));
    }

    //report strategicos
    public function reportSuggestionsByType($typeId, $type, $yi, $yf){
      if(Auth::user()->hasPermissionTo('suggestions_estrategic')){
          $tipo = null; $data = null;
          if ($typeId == 0) {
              $tipo = 'TODOS LOS TIPOS';
          $data =  Suggestion::join('suggestion_types','suggestion_types.id','suggestions.suggestion_type_id')
              ->whereBetween( DB::raw('year(suggestions.date)'),[$yi,$yf])
              // ->where('suggestions.suggestion_type_id',$typeId)
              ->select( DB::raw('year(suggestions.date) as year') ,'suggestions.suggestion_type_id AS id_sugerencia','suggestions.suggestion_type as tipo', DB::raw('COUNT(suggestions.reading) AS lectura')  )
              ->groupBy('year','suggestions.suggestion_type_id','suggestions.suggestion_type')
              ->orderBy('tipo')
              ->get();
          }else {

              $tipo = SuggestionType::find($typeId);
              $data =  Suggestion::join('suggestion_types','suggestion_types.id','suggestions.suggestion_type_id')
                  ->whereBetween( DB::raw('year(suggestions.date)'),[$yi,$yf])
                  ->where('suggestions.suggestion_type_id',$typeId)
                  ->select( DB::raw('year(suggestions.date) as year') ,'suggestions.suggestion_type_id AS id_sugerencia','suggestions.suggestion_type as tipo', DB::raw('COUNT(suggestions.reading) AS lectura')  )
                  ->groupBy('year','suggestions.suggestion_type_id','suggestions.suggestion_type')
                  ->orderBy('tipo')
                  ->get();
          }

          activity('Generación de reporte estratégico')
          ->by(Auth::user())
          ->log('El usuario '.Auth::user()->name.' generó el reporte de sugerencias realizadas por tipo del módulo de sugerencias.');


      if($type == 'pdf'){
          $pdf = PDF::loadView('pdf-reports.sugerencias.estrategico-pdf', compact('data','yi','yf','tipo','typeId'));
          return $pdf->download('Periodo_'.$yi.'--'.$yf.'_Modulo_sugerencias_por_tipo.pdf');
        }
        elseif ($type == 'excel') {
          return \Excel::download(new SugestionStrategic($data, $yi, $yf, $tipo, $typeId),'Periodo_'.$yi.'--'.$yf.'_Modulo_sugerencias_por_tipo.xlsx');
        }
      }      
      else{
        activity('Acceso denegado')
        ->by(Auth::user())
        ->log('El usuario '.Auth::user()->name.' intentó generar el reporte de sugerencias realizadas por tipo del módulo de sugerencias.');
        abort(403,__('Unauthorized'));
      }
        
    }

    //tacticos
    public function reportSuggestionsByDate($typeId, $format, $fi, $ff){
      //
      if(Auth::user()->hasPermissionTo('suggestions_tactical')  ){
        $query = '';
        $text = 'Modulo_Sugerencias';
        $tipo = '';

        if($typeId == 0){//flujo cuando son todos los tipos los requeridos
          $tipo = "TODAS";
          $text = $text."_Todos";
          if($fi == 'no' && $ff != 'no'){ //cuando hay fecha final pero no hay de inicio
            $end_date = Carbon::createFromFormat('Y-m-d',$ff);
            $query = Suggestion::where('date','<=',$end_date)->with('employee')->get();
            $text=$text.'_hasta_'.$end_date->format('d-m-Y');
          }
          elseif($fi != 'no' && $ff == 'no') { //cuando hay fecha de inicio pero no final
            $start_date = Carbon::createFromFormat('Y-m-d H',$fi.'0');
            $query = Suggestion::where('date','>=',$start_date)->with('employee')->get();
            $text=$text.'_desde_'.$start_date->format('d-m-Y');
          }
          elseif ($fi == 'no' && $ff == 'no') {
            $query = Suggestion::with('employee')->get();
          }
          else{ //cuando hay fechas de inicio y fin
            $end_date = Carbon::createFromFormat('Y-m-d',$ff);
            $start_date = Carbon::createFromFormat('Y-m-d H',$fi.'0');

            $query = Suggestion::whereBetween('date',array($start_date,$end_date))->with('employee')->get();

            $text=$text.'_desde_'.$start_date->format('d-m-Y').'_hasta_'.$end_date->format('d-m-Y');
          }
        }
        else{//flujo cuando se especifica de qué tipo se quiere
          $tipo = SuggestionType::where('id','=',$typeId)->get()->first();
          $text = $text."_".$tipo->suggestion_type;

          if($fi == 'no' && $ff != 'no'){ //cuando hay fecha final pero no hay de inicio
            $end_date = Carbon::createFromFormat('Y-m-d',$ff);
            $query = Suggestion::where('date','<=',$end_date)
                                ->where('suggestion_type_id','=',$typeId)->with('employee')->get();
            $text=$text.'_hasta_'.$end_date->format('d-m-Y');
          }
          elseif($fi != 'no' && $ff == 'no') { //cuando hay fecha de inicio pero no final
            $start_date = Carbon::createFromFormat('Y-m-d H',$fi.'0');
            $query = Suggestion::where('date','>=',$start_date)
                                ->where('suggestion_type_id','=',$typeId)->with('employee')->get();
            $text=$text.'_desde_'.$start_date->format('d-m-Y');
          }
          elseif ($fi == 'no' && $ff == 'no') {
            $query = Suggestion::where('suggestion_type_id','=',$typeId)->with('employee')->get();
          }
          else{ //cuando hay fechas de inicio y fin
            $end_date = Carbon::createFromFormat('Y-m-d',$ff);
            $start_date = Carbon::createFromFormat('Y-m-d H',$fi.'0');
            $query = Suggestion::whereBetween('date',array($start_date,$end_date))
                                ->where('suggestion_type_id','=',$typeId)->with('employee')->get();
            $text=$text.'_desde_'.$start_date->format('d-m-Y').'_hasta_'.$end_date->format('d-m-Y');
          }
        }

        activity('Generación de reporte táctico')
        ->by(Auth::user())
        ->log('El usuario '.Auth::user()->name.' generó el reporte de sugerencias realizadas por fechas del módulo de sugerencias.');

        if($format == 'pdf'){
          $pdf = PDF::loadView('pdf-reports.sugerencias.tactico', compact('query','text','fi','ff','tipo'));          
          return $pdf->setPaper('A4','landscape')->stream($text.'.pdf');
        }
        elseif ($format == 'excel') {          
          return Excel::download(new SuggestionsR2_Export($query,$text,$fi,$ff,$tipo),$text.'.xlsx');
        }
      }
      else{
        activity('Acceso denegado')
        ->by(Auth::user())
        ->log('El usuario '.Auth::user()->name.' intentó generar el reporte de sugerencias realizadas por fechas del módulo de sugerencias.');
        abort(403,__('Unauthorized'));
      }
    }
}
