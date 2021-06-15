<?php

namespace App\Http\Controllers\Publications;

use App\Exports\Publications\PublicacionesAlcance_Export;
use App\Help\Help;
use App\Http\Controllers\Controller;
use App\Models\Publication;
use Barryvdh\DomPDF\Facade as PDF;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\Publications\PublicacionesAnio_Export;
use App\Exports\Publications\PublicacionTactico_Export;

class PublicationsController extends Controller
{
    public function __construct()
    {
        set_time_limit(8000000);
        ini_set('memory_limit', '1G');
        $this->middleware('auth');
    }

    public function home()
    {
        $help = new Help();
        $publications = Publication::pluck('title', 'id');
        activity('Visita')
            ->by(Auth::user())
            ->log('El usuario ' . Auth::user()->name . ' visitó /publications/home.');
        return view('publications.home', compact('help', 'publications'));
    }

    //Estrategicos
    public function publishedByYear($formato, $year)
    {
        $permiso =  Auth::user()->hasPermissionTo('publications_estrategic');
        $reporte = 'Publicaciones realizadas en el año ' . $year;

        if (!$permiso) {
            $this->log_denied($reporte);
            abort(403, __('Unauthorized'));
        }

        $publicaciones = Publication::where('year', $year)->get();
        $titulo = "Modulo_publicaciones_REALIZADAS_EN_" . $year;

        $this->log_report($reporte, 'estratégico', $formato);

        if ($formato == 'pdf') {
            $pdf = PDF::loadView(
                'pdf-reports.publicaciones.publicaciones-anio-estrategico',
                compact('publicaciones', 'titulo', 'year')
            );
            return $pdf->setPaper('A4', 'landscape')->stream($titulo . '.pdf');
        }

        if ($formato == 'excel') {
            return Excel::download(new PublicacionesAnio_Export($publicaciones, $titulo, $year), $titulo . '.xlsx');
        }
    }

    public function reachByYear($formato, $year)
    {
        $permiso = Auth::user()->hasPermissionTo('publications_estrategic');
        $reporte = 'Alcance de las publicaciones realizadas en el año ' . $year;

        if (!$permiso) {
            $this->log_denied($reporte);
            abort(403, __('Unauthorized'));
        }

        $publicaciones = Publication::where('year', $year)->get();
        $titulo = "Modulo_publicaciones_ALCANCE_DE_" . $year;

        $this->log_report($reporte, 'estratégico', $formato);

        if ($formato == 'pdf') {
            $pdf = PDF::loadView(
                'pdf-reports.publicaciones.publicaciones-alcance-estrategico',
                compact('publicaciones', 'titulo', 'year')
            );
            return $pdf->setPaper('A4', 'landscape')->stream($titulo . '.pdf');
        }

        if ($formato == 'excel') {
            return Excel::download(new PublicacionesAlcance_Export($publicaciones, $titulo, $year), $titulo . '.xlsx');
        }
    }

    //Tactico
    public function seen($formato, $pub_id)
    {
        $permiso = Auth::user()->hasPermissionTo('publications_tactical');
        $reporte = 'Personas que han visto o no una publicación';

        if (!$permiso) {
            $this->log_denied($reporte);
            abort(403, __('Unauthorized'));
        }

        $publicacion = Publication::findOrFail($pub_id);
        $titulo = "Modulo_publicaciones_" . $publicacion->title;

        $this->log_report($reporte, 'táctico', $formato);

        if ($formato == 'pdf') {
            $pdf = PDF::loadView(
                'pdf-reports.publicaciones.publicaciones-tactico',
                compact('publicacion', 'titulo')
            );
            return $pdf->setPaper('A4', 'landscape')->stream($titulo . '.pdf');
        }

        if ($formato == 'excel') {
            return Excel::download(new PublicacionTactico_Export($publicacion, $titulo), $titulo . '.xlsx');
        }
    }

    private function log_report($reporte, $tipo, $formato)
    {
        activity('Generación de reporte ' . $tipo)
            ->by(Auth::user())
            ->log('El usuario ' . Auth::user()->name .
                ' generó el reporte de ' . $reporte . ' del Módulo de Publicaciones en formato ' . Str::upper($formato));
    }

    private function log_denied($reporte)
    {
        activity('Acceso denegado')
            ->by(Auth::user())
            ->log('El usuario ' . Auth::user()->name .
                ' intentó generar el reporte de ' . $reporte . ' del Módulo de Publicaciones.');
    }
}
