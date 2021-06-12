<?php

namespace App\Http\Controllers\ISO;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade as PDF;
use Maatwebsite\Excel\Facades\Excel;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\Help\Help;
use App\Models\Container;
use App\Models\SubContainer;
use App\Models\Archive;
use App\Models\ArchiveType;
use App\Models\History;

class ISOController extends Controller
{
  public function __construct(){
    set_time_limit(8000000);
    ini_set('memory_limit', '1G');

    $this->middleware('auth');
  }

  public function home(){
    $help = new Help();
    $containers = Container::all();
    return view ('iso.home',compact('help','containers'));
  }


    public function r1_($format, $container){

      $contenedores = array();
      $titulo = "reporte-general-procesos-".Help::dateYear();
      if(isset($request->proceso)){
        $contenedores = Container::where('id',$container)->get();
        $titulo = "reporte-general-proceso-". Help::replace_char($contenedores[0]->titulo)."-".Help::dateYear();
      }else{
        $contenedores = Container::all();
      }

      if($format =='pdf'){
        $pdf = \PDF::loadView('pdf-reports.iso.r1', compact('contenedores','titulo'));
        return $pdf->setPaper('a4', 'landscape')->stream($titulo."-.pdf"  );
      }


    }
}
