<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">

    {{-- <title>TITULO</title> --}}
  </head>
  <body>
    <div class="col-md-12">
        <div class="mb-2 row">
            <div class="text-left col-md-5">
                <img src="{{asset('images/logos/catalana.jpg')}}" height="70px" width="175px" alt="">
            </div>
            <div class="col-md-7">
                <h5 class="text-center">Reporte de Cantidad de cuestionarios</h5>
                <h5 class="text-center"> respondidos y no respondidos</h5>
                <h5 class="text-center">{{$yeari}}-{{$yearf}}</h5>
            </div>
        </div>
    </div>
    <div class="text-center">
       <table class="table table-light">
           <thead class="thead-light">
               <tr>
                   <th>Año</th>
                   <th>Capacitacion</th>
                   <th>Empleados Asignados</th>
                   <th>Cuestionarios Realizados</th>
                   <th>Cuestionarios No Realizados</th>
               </tr>
           </thead>
           <tbody>
              @foreach ($data as $item)
              @php
                  $Norealizados = $item->total - $item->realizados
              @endphp
                <tr>
                    <td>{{$item->year}}</td>
                    <td>{{$item->capacitacion}}</td>
                    <td>{{$item->total}}</td>
                    <td>{{$item->realizados}}</td>
                    <td>{{$Norealizados}}</td>
                </tr>
              @endforeach
           </tbody>
       </table>



    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
  </body>
</html>
