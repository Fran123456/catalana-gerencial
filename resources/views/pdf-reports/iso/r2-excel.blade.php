
<html lang="en">
<head>
@include('pdf-reports.iso.style')
</head>
<body>


    <table>
      <tr>
        <th colspan="2"><img style="float: left" src="images/logos/catalana.jpg" alt="" width="160" height="50"></th>
        <th colspan="8" style="font-size:20px" class="text-center"><strong> REPORTE DE PROCESOS POR TIPO DE DOCUMENTO </strong> </th>
      </tr>
    </table>



      @foreach ($tipos as $key => $tipo)
        <table>
          <tr>
            <th colspan="2"><strong> <u>{{$tipo->type}}</u> </strong>  </th>
          </tr>

        </table>
        @if (count( $tipo->activeFile($tipo->id) ) > 0)

          <table class="table table-striped">
            <thead>
              <tr style="font-size: 85%">
                <th scope="col" >#</th>
                <th scope="col">Proceso</th>
                <th scope="col">Sub Proceso</th>
                <th scope="col">Documento Activo</th>
                <th width="100px" scope="col">Codigo</th>
                <th width="100px" scope="col">Edición</th>


              </tr>
            </thead>
            <tbody>
              @foreach ($tipo->activeFile($tipo->id) as $key => $archivo)
                @php
                  $back2 = $archivo->subcontainer->back($archivo->subcontainer->back);
                @endphp
                  <tr style="font-size: 80%">
                    <th width="20px" scope="row">{{$key + 1}}</th>
                    <td>{{$archivo->container->title}} ({{$archivo->container->code}}) </td>
                    <td>{{$back2->back($back2->back)->title}} ({{$back2->back($back2->back)->code}}) / {{$back2->title}} </td> <!--/ -->
                    <td> {{ $archivo->title . '-'. $archivo->code.".".$archivo->format}}  </td>
                      <td> {{$archivo->code}}  </td>
                      <td>{{$archivo->edition}}</td>


                  </tr>
             @endforeach
            </tbody>
          </table>
        @else
          <table>
            <tr>
            <th colspan="6">No hay sub procesos registrados</th>
            </tr>

          </table>

        @endif


      @endforeach


</body>
</html>
