<?php

namespace App\Http\Controllers\System;

use App\Exports\System\LogsExport;
use App\Help\Help;
use App\Http\Controllers\Controller;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Spatie\Activitylog\Models\Activity;
use Barryvdh\DomPDF\Facade as PDF;
use Maatwebsite\Excel\Facades\Excel;

class SystemController extends Controller
{

    public function __construct(){
        set_time_limit(8000000);
        ini_set('memory_limit', '1G');
    
        $this->middleware('auth');
      }

      public function system(){
        if(Auth::user()->hasPermissionTo('logs')){
            $help = new Help();        
            return view('system.system',compact('help'));
        }
        else{
            abort(403,__('Unauthorized'));
        }        
    }

    public function printLogs($format,$yi,$yf){        
        if(Auth::user()->hasPermissionTo('logs')){
            $text = 'Bitácora_del_sistema';            
            $query = '';
            $start_date = 'no';
            $end_date = 'no';            

            activity('system/print-logs/'.$format."/".$yi."/".$yf)
            ->by(Auth::user())
            ->log('El usuario '.Auth::user()->name.' generó el reporte de bitácora del sistema.');

            if($yi != 'no' && $yf != 'no'){
                $end_date = Carbon::createFromFormat('Y-m-d',$yf);
                $start_date = Carbon::createFromFormat('Y-m-d',$yi);

                $query = DB::table('activity_log')
                        ->join('users','activity_log.causer_id','=','users.id')
                        ->whereBetween('activity_log.created_at',array($start_date,$end_date))                    
                        ->select('activity_log.causer_id','activity_log.description','activity_log.created_at','activity_log.log_name','users.name')
                        ->get();                

                $text = $text.'_desde_'.$start_date->format('d-m-Y').'_hasta_'.$end_date->format('d-m-Y');                
            }
            if($yi != 'no' && $yf == 'no'){
                $start_date = Carbon::createFromFormat('Y-m-d',$yi);

                $query = DB::table('activity_log')
                        ->join('users','activity_log.causer_id','=','users.id')
                        ->where('activity_log.created_at','>=',$start_date)
                        ->select('activity_log.causer_id','activity_log.description','activity_log.created_at','activity_log.log_name','users.name')
                        ->get();              
                $text = $text.'_desde_'.$start_date->format('d-m-Y');
            }
            if($yi == 'no' && $yf != 'no'){
                $end_date = Carbon::createFromFormat('Y-m-d',$yf);                
                $query = DB::table('activity_log')
                        ->join('users','activity_log.causer_id','=','users.id')
                        ->where('activity_log.created_at','<=',$end_date)
                        ->select('activity_log.causer_id','activity_log.description','activity_log.created_at','activity_log.log_name','users.name')
                        ->get();              
                $text = $text.'_hasta_'.$end_date->format('d-m-Y');
            }
            if($yi == 'no' && $yf == 'no'){
                $query = DB::table('activity_log')
                ->join('users','activity_log.causer_id','=','users.id')                                
                ->select('activity_log.causer_id','activity_log.description','activity_log.created_at','activity_log.log_name','users.name')
                ->get();  
                $text = $text.'_TODOS';
            }            
            if($start_date != 'no'){
                $start_date = $start_date->format('m-d-Y');
            }
            if($end_date != 'no'){
                $end_date = $end_date->format('m-d-Y');
            }            

            if($format == 'pdf'){
                $pdf = PDF::loadView('pdf-reports.system.logs', compact('query','text','start_date','end_date'));                
                return $pdf->setPaper('A4','landscape')->stream($text.'.pdf');
              }
              elseif ($format == 'excel') {                
                return Excel::download(new LogsExport($query,$start_date,$end_date),$text.'.xlsx');
              }
        }

        else{
            abort(403,__('Unauthorized'));        
        }
    
    }
}
