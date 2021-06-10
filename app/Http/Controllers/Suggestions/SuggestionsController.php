<?php

namespace App\Http\Controllers\Suggestions;

use App\Exports\Suggestions\SuggestionsExport;
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

class SuggestionsController extends Controller
{
    public function __construct(){
      set_time_limit(8000000);
      $this->middleware('auth');
    }

    public function home(){
       $types = SuggestionType::all();
       $help = new Help();
      return view ('suggestions.home',compact('types','help'));
    }

    //report strategicos
    public function reportSuggestionsByType($typeId, $format, $yi, $yf){

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

        if($format == 'pdf'){
          $pdf = PDF::loadView('pdf-reports.sugerencias.tactico', compact('query','text','fi','ff','tipo'));
          return $pdf->setPaper('A4','landscape')->stream($text.'.pdf');
        }
        elseif ($format == 'excel') {
          return Excel::download(new SuggestionsExport($query,$text,$fi,$ff,$tipo),$text.'.xlsx');
        }
      }
      else{
        abort(403,__('Unauthorized'));
      }
    }
}
