<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">

    <title>{{$titulo}}</title>
  </head>
  <body>
  <style>
    .page-break {
        page-break-after: always;
    }    
    </style>
    <div class="col-md-12">
        <div class="row mb-2">
            <div class="col-md-5 text-left">
                <img src="{{asset('images/logos/catalana.jpg')}}" height="70px" width="175px" alt="">
            </div>
            <div class="col-md-7">
                <div class="card">
                    <h5 class="card-title text-center pt-3"> Reporte de los empleados que han visto o no una publicación</h5>
                </div>        
            </div>
        </div>
    </div>    
    <div class="text-center">
        <div class="card">
            <div class="card-body">
                <table class="table table-sm table-bordered" style="margin-top: -3rem; margin-bottom:-0.75rem;">
                    <thead class="thead-dark">                    
                        <tr>
                            <th style="font-size:90%" scope="col" colspan="2">Datos generales</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td style="font-size:90%" colspan="1"><strong>Publicacion</strong></td>
                                <td style="font-size:90%" colspan="1">{{$publicacion->title}}</td>                  
                        </tr>
                        <tr>
                            <td style="font-size:90%" colspan="1"><strong>Tipo</strong></td>
                                <td style="font-size:90%" colspan="1">{{$publicacion->type}}</td>                  
                        </tr>
                        <tr>
                            <td style="font-size:90%" colspan="1"><strong>Año</strong></td>
                                <td style="font-size:90%" colspan="1">{{$publicacion->year}}</td>                  
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
        <div class="text-center">
            <div class="card">
                <div class="card-body">             
                    <table class="table table-sm table-bordered">
                        <thead class="thead-dark">
                            <tr>
                                <th style="font-size:90%"scope="col" width="25px">#</th>
                                <th style="font-size:90%"scope="col" width="150px">Empleado</th>                                
                                <th style="font-size:90%"scope="col" width="150px">DUI</th>
                                <th style="font-size:90%"scope="col" width="150px">Empresa</th>
                                <th style="font-size:90%"scope="col" width="100px">Área</th>
                                <th style="font-size:90%"scope="col" width="100px">Vista</th>
                            </tr>
                        </thead>
                        <tbody>                        
                            @if ($publicacion->empleados->count() == 0)
                                <tr><td style="font-size:90%" colspan="5"><p>No se encontraron registros</p></td></tr>                
                            @else
                                @foreach ($publicacion->empleados as $id => $empleado)
                                    <tr>
                                        <td style="font-size:90%">{{$loop->iteration}}</td>
                                        <td style="font-size:90%">{{$empleado->names}} {{$empleado->lastnames}}</td>
                                        <td style="font-size:90%">{{$empleado->dui}}</td>
                                        <td style="font-size:90%">{{$empleado->enterprise->enterprise}}</td>
                                        <td style="font-size:90%">{{$empleado->area->area}}</td>
                                        <td style="font-size:90%">{{($empleado->detalle->seen ? 'SI' : 'NO')}}</td>
                                    </tr>
                                @endforeach
                            @endif
                        </tbody>
                    </table>                    
                        <div class="page-break"></div>       
                </div>
            </div>        
        </div>     
  </body>
</html>