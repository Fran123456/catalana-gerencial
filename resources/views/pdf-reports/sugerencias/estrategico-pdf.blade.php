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
                <h5 class="text-center" >Reporte de Sugerencias. </h5>
                @if ($typeId == 0 )
                <h5 class="text-center">Tipo: {{$tipo}} </h5>
                @else
                <h5 class="text-center">Tipo: {{$tipo->suggestion_type}} </h5>
                @endif

                <h5 class="text-center" >{{$yi}}-{{$yf}}</h5>
            </div>
        </div>
    </div>
    <div class="text-center">
       <table class="table table-light">
           <thead class="thead-light">
               <tr>
                   <th>Año</th>
                   <th>Tipo</th>
                   <th>Visualizaciones</th>

               </tr>
           </thead>
           <tbody>
              @foreach ($data as $item)

                <tr>
                    <td>{{$item->year}}</td>
                    <td>{{$item->tipo}}</td>
                    <td>{{$item->lectura}}</td>

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
