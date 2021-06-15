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
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Storage;
use Maatwebsite\Excel\Facades\Excel;

class SystemController extends Controller
{

    public function __construct(){
        set_time_limit(8000000);
        ini_set('memory_limit', '1G');
    
        $this->middleware('auth');
      }

      public function system(){
        if(Auth::user()->hasPermissionTo('system')){
            $help = new Help();
            activity('Visita')
            ->by(Auth::user())
            ->log('El usuario '.Auth::user()->name.' visitó /system');
            return view('system.system',compact('help'));
        }
        else{
            activity('Acceso denegado')
            ->by(Auth::user())
            ->log('El usuario '.Auth::user()->name.' intentó visitar /system sin permiso para hacerlo.');
            abort(403,__('Unauthorized'));
        }        
    }

    public function printLogs($format,$yi,$yf){        
        if(Auth::user()->hasPermissionTo('logs')){
            $text = 'Bitácora_del_sistema';            
            $query = '';
            $start_date = 'no';
            $end_date = 'no';            

            activity('Generación de reporte de bitácora de sistema')
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
            activity('Acceso denegado')
            ->by(Auth::user())
            ->log('El usuario '.Auth::user()->name.' intentó generar el reporte de bitácora del sistema sin permiso para hacerlo.');
            abort(403,__('Unauthorized'));        
        }    
    }

    public function backupDatabase(){
        if(Auth::user()->hasPermissionTo('backup')){
            activity('Generación de respaldo de base de datos')
            ->by(Auth::user())
            ->log('El usuario '.Auth::user()->name.' generó un respaldo de la base de datos.'); 
            
            if(Storage::exists('Laravel')){
                Storage::deleteDirectory('Laravel');
            }            
            Artisan::call('backup:run',['--disable-notifications' => true , '--only-db' => true]);
            $path = storage_path('app\Laravel\*');            
            $latest_ctime = 0;
            $latest_filename = '';
            $files = glob($path);
            foreach($files as $file)
            {
                    if (is_file($file) && filectime($file) > $latest_ctime)
                    {
                            $latest_ctime = filectime($file);
                            $latest_filename = $file;
                    }
            }                        
            return response()->download($latest_filename);            
        }            
        else{
            activity('Acceso denegado')
            ->by(Auth::user())
            ->log('El usuario '.Auth::user()->name.' intentó realizar un respaldo a la base de datos sin permiso para hacerlo.');
            abort(403,__('Unauthorized'));
        }
    }        
}