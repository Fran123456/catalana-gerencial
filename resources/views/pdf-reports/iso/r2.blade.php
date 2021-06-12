<!DOCTYPE html>
<html lang="en">
<head>
  <title>{{$titulo}}</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    @include('pdf-reports.iso.style')
</head>
<body>
    <div class="text-center " >

      <img style="float: left" src="images/logos/catalana.jpg" alt="" width="160" height="50">

      <div class="" style="padding-left:10px">
        <p style="font-size:21px"> <strong> REPORTE DE PROCESOS POR TIPO DE DOCUMENTO </strong> </p>
      </div>
    </div>
    <br>

    @foreach ($tipos as $key => $tipo)
      <p style="font-size:18px"> <strong> <u>{{$tipo->type}}</u> </strong> </p>
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
        <p>No hay sub procesos registrados</p>
      @endif


    @endforeach


</body>
</html>
