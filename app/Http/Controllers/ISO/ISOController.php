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
    $types = ArchiveType::all();
    return view ('iso.home',compact('help','containers','types'));
  }


    public function r1_($format, $container){

      $contenedores = array();
      $titulo = "reporte-general-procesos-".Help::dateYear();
      if($container!='0'){
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

   public function r2_($format, $type){
     $tipos = array();
     $titulo = "reporte-por-tipo-documentos-".Help::dateYear();
      if ($type!='0') {
               $tipos = ArchiveType::where('id',$type)->get();
               $titulo = "reporte-por-tipo-documento-". Help::replace_char($tipos[0]->titulo)."-".Help::dateYear();
      }else{
             $tipos = ArchiveType::all();
      }

      if ($format=='pdf') {
        $pdf = \PDF::loadView('pdf-reports.iso.r2', compact('tipos','titulo'));
        return $pdf->setPaper('a4', 'landscape')->stream($titulo . "-.pdf"  );
      }
   }


}
