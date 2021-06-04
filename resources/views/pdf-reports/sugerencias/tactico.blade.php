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
    <div class="col-md-12">
        <div class="row mb-2">
            <div class="col-md-5 text-left">
                <img src="{{asset('images/logos/catalana.jpg')}}" height="70px" width="175px" alt="">
            </div>
            <div class="col-md-7">
                <div class="card">
                    <h4 class="card-title text-center pt-2"> Reporte nivel táctico módulo sugerencias</h4>
                </div>        
            </div>
        </div>
    </div>    
    <div class="text-center">
        <table class="table table-sm table-bordered" style="margin-top: -3rem;">
            <thead class="thead-dark">                    
                <tr>
                    <th style="font-size:90%" scope="col" colspan="3">Parámetros</th>                        
                </tr>
            </thead>
            <tbody>
                <tr>
                    <th style="font-size:90%">Tipo de sugerencia</th>
                    <th style="font-size:90%">Fecha inicial</th>
                    <th style="font-size:90%">Fecha final</th>
                </tr>
                <tr>
                    @if ($tipo == "TODAS")
                        <td style="font-size:90%">{{$tipo}}</td>
                    @else
                        <td style="font-size:90%">{{$tipo->suggestion_type}}</td>
                    @endif                
                    @if ($fi == 'no')
                        <td style="font-size:90%">No ingresada</td>
                    @else
                        <td style="font-size:90%">{{Carbon\Carbon::createFromFormat('Y-m-d',$fi)->format('d-m-Y')}}</td>
                    @endif
                    @if ($ff == 'no')
                        <td style="font-size:90%">No ingresada</td>
                    @else
                        <td style="font-size:90%">{{Carbon\Carbon::createFromFormat('Y-m-d',$ff)->format('d-m-Y')}}</td>
                    @endif                    
                </tr>
            </tbody>
        </table>
        
        <div class="card">
            <table class="table table-sm table-bordered">
                <thead class="thead-dark">                    
                    <tr>
                        <th style="font-size:90%"scope="col" width="30px">#</th>                        
                        @if ($tipo == "TODAS")
                            <th style="font-size:90%" scope="col" width="350px">Sugerencia</th>
                            <th style="font-size:90%" scope="col">Tipo de sugerencia</th>                                                    
                        @else
                            <th style="font-size:90%" scope="col" width="400px">Sugerencia</th>
                        @endif             
                        <th style="font-size:90%">Fecha</th>
                        <th style="font-size:90%">Id Empleado</th>
                        <th style="font-size:90%">Empleado</th>
                    </tr>
                </thead>
                <tbody>                              
                @if ($query->count() == 0)
                    @if ($tipo == "TODAS")
                    <tr><td colspan="5"><p>No se encontraron sugerencias con los parámetros ingresados</p></td></tr>
                    @else
                    <tr><td colspan="4"><p>No se encontraron sugerencias con los parámetros ingresados</p></td></tr>
                    @endif    
                @else
                    @foreach ($query as $key => $row)
                        <tr>
                            <td style="font-size:90%">{{$key + 1}}</td>
                            <td style="font-size:90%">{{$row->suggestion}}</td>
                            @if ($tipo == "TODAS")
                            <td style="font-size:90%">{{$row->suggestion_type}}</td>
                            @endif
                            <td style="font-size:90%">{{Carbon\Carbon::createFromTimeString($row->date)->format('d-m-Y H:i:s')}}</td>
                            <td style="font-size:90%">{{$row->employee_id}}</td>
                            <td>{{$row->employee->names}} {{$row->employee->lastnames}}</td>
                        </tr>
                    @endforeach
                @endif
                </tbody>
            </table>
        </div>
    </div>

    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
  </body>
</html>