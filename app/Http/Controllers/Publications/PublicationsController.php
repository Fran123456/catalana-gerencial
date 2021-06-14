<?php

namespace App\Http\Controllers\Publications;

use App\Exports\Publications\PublicacionesAlcance_Export;
use App\Help\Help;
use App\Http\Controllers\Controller;
use App\Models\Publication;
use Barryvdh\DomPDF\Facade as PDF;
use Illuminate\Support\Facades\Auth;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\Publications\PublicacionesAnio_Export;
use App\Exports\Publications\PublicacionTactico_Export;

class PublicationsController extends Controller
{
    public function __construct()
    {
        set_time_limit(8000000);
        $this->middleware('auth');
    }

    public function home()
    {
        $help = new Help();
        $publications = Publication::pluck('title', 'id');
        return view('publications.home', compact('help', 'publications'));
    }

    //Estrategicos
    public function publishedByYear($format, $year)
    {
        abort_unless(
            Auth::user()->hasPermissionTo('publications_estrategic'),
            403,
            __('Unauthorized')
        );

        $publicaciones = Publication::where('year', $year)->get();
        $titulo = "Modulo_publicaciones_REALIZADAS_EN_" . $year;

        //return view('pdf-reports.publicaciones.publicaciones-anio-estrategico', compact('publicaciones', 'titulo', 'year'));
        if ($format == 'pdf') {
            $pdf = PDF::loadView('pdf-reports.publicaciones.publicaciones-anio-estrategico', compact('publicaciones', 'titulo', 'year'));
            return $pdf->setPaper('A4', 'landscape')->stream($titulo . '.pdf');
        }

        if ($format == 'excel') {
            return Excel::download(new PublicacionesAnio_Export($publicaciones, $titulo, $year), $titulo . '.xlsx');
        }

        dd($publicaciones, $year, $publicaciones->count());
    }

    public function reachByYear($format, $year)
    {
        abort_unless(
            Auth::user()->hasPermissionTo('publications_estrategic'),
            403,
            __('Unauthorized')
        );

        $publicaciones = Publication::where('year', $year)->get();
        $titulo = "Modulo_publicaciones_ALCANCE_DE_" . $year;

        abort_if(!$publicaciones->count(), 200, 'No hay publicaciones correspondientes al año ' . $year);

        if ($format == 'pdf') {
            $pdf = PDF::loadView('pdf-reports.publicaciones.publicaciones-tactico', compact('publicaciones', 'titulo', 'year'));
            return $pdf->setPaper('A4', 'landscape')->stream($titulo . '.pdf');
        }

        if ($format == 'excel') {
            return Excel::download(new PublicacionesAlcance_Export($publicaciones, $titulo, $year), $titulo . '.xlsx');
        }

        dd($publicaciones, $format);
    }

    //Tactico
    public function seen($format, $pub_id)
    {
        abort_unless(Auth::user()->hasPermissionTo('publications_tactical'), 403, __('Unauthorized'));

        $publicacion = Publication::findOrFail($pub_id);
        $titulo = "Modulo_publicaciones_" . $publicacion->title;

        if ($format == 'pdf') {
            $pdf = PDF::loadView('pdf-reports.publicaciones.publicaciones-tactico', compact('publicacion', 'titulo'));
            return $pdf->setPaper('A4', 'landscape')->stream($titulo . '.pdf');
        }

        if ($format == 'excel') {
            return Excel::download(new PublicacionTactico_Export($publicacion, $titulo), $titulo . '.xlsx');
        }
    }
}
