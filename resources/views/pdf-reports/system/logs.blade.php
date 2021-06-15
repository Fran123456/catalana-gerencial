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
                    <h4 class="card-title text-center pt-2">Reporte de bitácora del sistema</h5>
                </div>        
            </div>
        </div>
    </div>    
    <div class="text-center">
        <table class="table table-sm table-bordered" style="margin-top: -3rem;">
            <thead class="thead-dark">                    
                <tr>
                    <th style="font-size:90%" scope="col" colspan="2">Parámetros</th>                        
                </tr>
            </thead>
            <tbody>
                <tr>                    
                    <th style="font-size:90%">Fecha inicial</th>
                    <th style="font-size:90%">Fecha final</th>
                </tr>
                <tr>                            
                    @if ($start_date == 'no')
                        <td style="font-size:90%">No ingresada</td>
                    @else
                        <td style="font-size:90%">{{$start_date}}</td>                        
                    @endif
                    @if ($end_date == 'no')
                        <td style="font-size:90%">No ingresada</td>
                    @else
                        <td style="font-size:90%">{{$end_date}}</td>
                    @endif                    
                </tr>
            </tbody>
        </table>
        
        <div class="card">
            <table class="table table-sm table-bordered">
                <thead class="thead-dark">                    
                    <tr>
                        <th style="font-size:90%"scope="col" width="30px">#</th>                                                
                        <th style="font-size:90%" scope="col" width="90px">ID Usuario</th>
                        <th style="font-size:90%" scope="col" width="150px">Usuario</th>
                        <th style="font-size:90%" scope="col" width="300px">Descripción</th>
                        <th style="font-size:90%" scope="col" width="100px">Acción</th>
                        <th style="font-size:90%">Fecha</th>                        
                    </tr>
                </thead>
                <tbody>                              
                @if ($query->count() == 0)                    
                    <tr><td style="font-size:90%" colspan="6"><p>No se encontraron logs con los parámetros ingresados</p></td></tr>                    
                @else
                    @foreach ($query as $key => $row)
                        <tr>
                            <td style="font-size:90%">{{$key + 1}}</td>
                            <td style="font-size:90%">{{$row->causer_id}}</td>                                                        
                            <td style="font-size:90%">{{$row->name}}</td>
                            <td style="font-size:90%">{{$row->description}}</td>
                            <td style="font-size:90%">{{$row->log_name}}</td>                            
                            <td style="font-size:90%">{{Carbon\Carbon::createFromTimeString($row->created_at)->format('d-m-Y H:i:s')}}</td>
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