<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">

    <title>Usuarios</title>
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
        <div class="card">
            <table class="table table-sm table-bordered">
                <thead class="thead-dark">                    
                    <tr>
                        <th style="font-size:90%"scope="col" width="30px">#</th>                        
                        <th style="font-size:90%" scope="col" width="200px">Nombre</th>
                        <th style="font-size:90%" scope="col" width="200px">Correo electrónico</th>
                        <th style="font-size:90%" scope="col" width="200px">Rol</th>
                    </tr>
                </thead>
                <tbody>                                              
                @foreach ($users as $key => $row)
                    <tr>
                        <td style="font-size:90%">{{$key + 1}}</td>
                        <td style="font-size:90%">{{$row->name}}</td>
                        <td style="font-size:90%">{{$row->email}}</td>
                        <td style="font-size:90%">{{$row->role}}</td>
                    </tr>
                @endforeach                
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