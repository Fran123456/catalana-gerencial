<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">

    <title></title>
  </head>
  <body>
  <style>
    .page-break {
        page-break-after: always;
    }
    </style>





    <table>
      <thead>
        <tr>
          <th width="100px"><img src="{{asset('images/logos/catalana.jpg')}}" height="70px" width="175px" alt=""></th>
          <th>  <h4 class="card-title text-center pt-2"> Reporte de empleados que resuelven o no una capacitación</h4></th>
        </tr>
      </thead>
    </table>

    <br><br><br>




      <table class="table table-sm table-bordered" style="margin-top: -3rem; margin-bottom:-0.75rem;">
            <thead class="thead-dark">
                  <tr>
                    <th  scope="col" colspan="3">Parámetros</th>
                  </tr>
            </thead>
            <tbody>
                <tr>
                    <td  colspan="1"><strong>Periodo</strong></td>
                    <td  colspan="1">Inicio: {{$yeari}}</td>
                    <td colspan="1">Fin: {{$yearf}}</td>
                </tr>
            </tbody>
      </table>

<br>

    @if (count($scores)>0)
     <table class="table table-sm table-bordered" style="font-size:12px">
       <thead class="thead-dark">
         <tr>
           <th>#</th>
           <th>capacitación</th>
           <th>Periodo</th>
           <th>Promedio</th>
         </tr>
       </thead>
       <tbody>
         @for ($i=0; $i < count($scores); $i++)
            <tr>
              <td>{{$i+1}}</td>
              <td>{{$scores[$i]['training']}}</td>
              <td>{{$scores[$i]['year']}}</td>
              <td>{{round($scores[$i]['score'], 2)}}</td>
            </tr>
         @endfor
       </tbody>
     </table>
    @else
      <h3>No hay datos para procesar</h3>
    @endif

  </body>
</html>
