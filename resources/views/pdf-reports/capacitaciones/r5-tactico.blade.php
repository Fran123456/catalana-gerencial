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
                    <h5 class="card-title text-center pt-3"> Reporte de empleados aprobados y reprobados de una capacitación</h5>
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
                    <h6 class="card-subtitle mb-2 text-left">Aprobados</h6>                
                    <table class="table table-sm table-bordered">
                        <thead class="thead-dark">
                            <tr>
                                <th style="font-size:90%"scope="col" width="25px">#</th>
                                <th style="font-size:90%"scope="col" width="20px">ID</th>
                                <th style="font-size:90%"scope="col" width="150px">Empleado</th>
                                <th style="font-size:90%"scope="col" width="30px">Nota</th>
                                <th style="font-size:90%"scope="col" width="150px">Empresa</th>
                                <th style="font-size:90%"scope="col" width="100px">Área</th>
                                <th style="font-size:90%"scope="col" width="100px">Depto.</th>
                                <th style="font-size:90%"scope="col" width="140px">Cargo</th>
                            </tr>
                        </thead>
                        <tbody>                        
                            @if ($aprobados[$key]->count() == 0)
                                <tr><td style="font-size:90%" colspan="8"><p>No se encontraron registros</p></td></tr>                
                            @else
                                @foreach ($aprobados[$key] as $num => $apr)
                                    <tr>
                                        <td style="font-size:90%">{{$num+1}}</td>
                                        <td style="font-size:90%">{{$apr->employee->id}}</td>
                                        <td style="font-size:90%">{{$apr->employee->names}} {{$apr->employee->lastnames}}</td>
                                        @if ($apr->score == NULL)
                                            <td style="font-size:90%">Sin Nota</td>
                                        @else
                                            <td style="font-size:90%">{{$apr->score}}</td>
                                        @endif                                    
                                        <td style="font-size:90%">{{$apr->employee->enterprise->enterprise}}</td>
                                        <td style="font-size:90%">{{$apr->employee->area->area}}</td>
                                        <td style="font-size:90%">{{$apr->employee->department->department}}</td>
                                        <td style="font-size:90%">{{$apr->employee->position->position}}</td>
                                    </tr>
                                @endforeach
                                @php
                                    $aprobados[$key] = null;
                                @endphp
                            @endif
                        </tbody>
                    </table>

                    <div class="page-break"></div>
                    <h6 class="card-subtitle mb-2 text-left">Reprobados</h6>

                    <table class="table table-sm table-bordered">
                        <thead class="thead-dark">
                            <tr>
                                <th style="font-size:90%"scope="col" width="25px">#</th>
                                <th style="font-size:90%"scope="col" width="20px">ID</th>
                                <th style="font-size:90%"scope="col" width="150px">Empleado</th>
                                <th style="font-size:90%"scope="col" width="30px">Nota</th>
                                <th style="font-size:90%"scope="col" width="150px">Empresa</th>
                                <th style="font-size:90%"scope="col" width="100px">Área</th>
                                <th style="font-size:90%"scope="col" width="100px">Depto.</th>
                                <th style="font-size:90%"scope="col" width="140px">Cargo</th>                                
                            </tr>
                        </thead>                        
                        <tbody>        
                            @if ($reprobados[$key]->count() == 0)
                                <tr><td style="font-size:90%" colspan="8"><p>No se encontraron registros</p></td></tr>                
                            @else
                                @foreach ($reprobados[$key] as $num => $repr)
                                    <tr>
                                        <td style="font-size:90%">{{$num+1}}</td>
                                        <td style="font-size:90%">{{$repr->employee->id}}</td>
                                        <td style="font-size:90%">{{$repr->employee->names}} {{$repr->employee->lastnames}}</td>
                                        @if ($apr->score == NULL)
                                            <td style="font-size:90%">Sin Nota</td>
                                        @else
                                            <td style="font-size:90%">{{$repr->score}}</td>
                                        @endif  
                                        <td style="font-size:90%">{{$repr->employee->enterprise->enterprise}}</td>
                                        <td style="font-size:90%">{{$repr->employee->area->area}}</td>
                                        <td style="font-size:90%">{{$repr->employee->department->department}}</td>
                                        <td style="font-size:90%">{{$repr->employee->position->position}}</td>
                                    </tr>
                                @endforeach                 
                                @php
                                    $reprobados[$key] = null;
                                @endphp                 
                            @endif        
                        </tbody>
                    </table>
                    
                    <div class="page-break"></div>
                    <h6 class="card-subtitle mb-2 text-left">Sin nota</h6>

                    <table class="table table-sm table-bordered">
                        <thead class="thead-dark">
                            <tr>
                                <th style="font-size:90%"scope="col" width="25px">#</th>
                                <th style="font-size:90%"scope="col" width="20px">ID</th>
                                <th style="font-size:90%"scope="col" width="150px">Empleado</th>                                
                                <th style="font-size:90%"scope="col" width="150px">Empresa</th>
                                <th style="font-size:90%"scope="col" width="100px">Área</th>
                                <th style="font-size:90%"scope="col" width="100px">Depto.</th>
                                <th style="font-size:90%"scope="col" width="140px">Cargo</th>
                            </tr>
                        </thead>                        
                        <tbody>        
                            @if ($sin_nota[$key]->count() == 0)
                                <tr><td style="font-size:90%" colspan="7"><p>No se encontraron registros</p></td></tr>                
                            @else
                                @foreach ($sin_nota[$key] as $num => $none)
                                    <tr>
                                        <td style="font-size:90%">{{$num+1}}</td>
                                        <td style="font-size:90%">{{$none->employee->id}}</td>
                                        <td style="font-size:90%">{{$none->employee->names}} {{$none->employee->lastnames}}</td>                                       
                                        <td style="font-size:90%">{{$none->employee->enterprise->enterprise}}</td>
                                        <td style="font-size:90%">{{$none->employee->area->area}}</td>
                                        <td style="font-size:90%">{{$none->employee->department->department}}</td>
                                        <td style="font-size:90%">{{$none->employee->position->position}}</td>
                                    </tr>
                                @endforeach                                  
                                @php
                                    $sin_notas[$key] = null;
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