<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">

    <title>{{$text}}</title>
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
                    <h5 class="card-title text-center pt-3"> Reporte de todos los empleados de una capacitación</h5>
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
                            <th style="font-size:90%" scope="col" colspan="2">Parámetros</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td style="font-size:90%" colspan="1"><strong>Capacitación</strong></td>
                            @if ($tipo =="TODAS")
                                <td style="font-size:90%" colspan="1">{{$tipo}}</td>
                            @else
                                <td style="font-size:90%" colspan="1">{{$tipo->training}}</td>
                            @endif                        
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>    
    @foreach ($query as $key => $table)
        <div class="text-center">
            <div class="card">
                <div class="card-body">
                    @if ($tipo == "TODAS")
                        <h5 class="card-title text-left">{{$table->training}}</h5>
                    @endif                    
                    <table class="table table-sm table-bordered">
                        <thead class="thead-dark">
                            <tr>
                                <th style="font-size:90%"scope="col" width="25px">#</th>
                                <th style="font-size:90%"scope="col" width="20px">ID</th>
                                <th style="font-size:90%"scope="col" width="150px">Empleado</th>                                
                                <th style="font-size:90%"scope="col" width="150px">Empresa</th>
                                <th style="font-size:90%"scope="col" width="100px">Área</th>
                                {{--<th style="font-size:90%"scope="col" width="100px">Depto.</th>
                                <th style="font-size:90%"scope="col" width="140px">Cargo</th>--}}
                            </tr>
                        </thead>
                        <tbody>                        
                            @if ($empleados[$key]->count() == 0)
                                <tr><td style="font-size:90%" colspan="5"><p>No se encontraron registros</p></td></tr>                
                            @else
                                @foreach ($empleados[$key] as $num => $apr)
                                    <tr>
                                        <td style="font-size:90%">{{$num+1}}</td>
                                        <td style="font-size:90%">{{$apr->id}}</td>
                                        <td style="font-size:90%">{{$apr->name}} {{$apr->lastname}}</td>
                                        <td style="font-size:90%">{{$apr->enterprise}}</td>
                                        <td style="font-size:90%">{{$apr->area}}</td>
                                        {{--<td style="font-size:90%">{{$apr->department}}</td>
                                        <td style="font-size:90%">{{$apr->position}}</td>--}}
                                    </tr>
                                @endforeach
                                @php
                                    $empleados[$key] = null;
                                @endphp
                            @endif
                        </tbody>
                    </table>                    
                    @if(!($loop->last))
                        <div class="page-break">    
                        </div>       
                    @endif
                </div>
            </div>        
        </div>
    @endforeach        
  </body>
</html>