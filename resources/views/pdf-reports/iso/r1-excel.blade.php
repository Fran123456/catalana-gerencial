
<html lang="en">
<head>
@include('pdf-reports.iso.style')
</head>
<body>


    <table>
      <tr>
        <th colspan="2"><img style="float: left" src="images/logos/catalana.jpg" alt="" width="160" height="50"></th>
        <th colspan="8" style="font-size:20px" class="text-center"><strong> REPORTE DE PROCESOS Y DOCUMENTO ACTIVO </strong> </th>
      </tr>
    </table>
    @foreach ($contenedores as $key => $contenedor)
      <table>
        <tr>
          <th colspan="2"><strong> <u>{{$contenedor->title}} ({{$contenedor->code}})</u> </strong></th>
        </tr>

      </table>
      @if (count($contenedor->subcontainers) > 0 )
        <table >
          <thead>
            <tr style="font-size: 85%">
              <th scope="col" >#</th>
              <th scope="col">Sub Proceso</th>
              <th scope="col">Documento Activo</th>
              <th scope="col" width="50px">Edición</th>
              <th scope="col" width="100px">Codigo</th>
              <th scope="col">Tipo Documento</th>
            </tr>
          </thead>
          <tbody>
            @php
              $c = 0;
            @endphp
            @foreach ($contenedor->subcontainers as $key => $subcontenedor)
              @if ($subcontenedor->order == 3)
                @php
                  $arc =$subcontenedor->activeFile($subcontenedor->id);
                  $back2 = $subcontenedor->back($subcontenedor->back);
                  $back1 = $back2->back($back2->back);
                @endphp
                <tr style="font-size: 80%">
                  <th width="20px" scope="row">{{$c + 1}}</th>
                  <td> {{$back1->title}} ({{$back1->code}}) / {{$back2->title}}  </td>
                  @if ($arc != null)
                  <td> {{ $arc->title . '-'. $arc->code.".".$arc->format}}</td>
                  <td>{{$arc->edition}}</td>
                  <td>{{$arc->code}}</td>

                  <td>{{$arc->archiveType->type}}</td>
                  @else
                    <td></td> <td></td> <td></td><td></td>
                  @endif
                </tr>
                @php
                  $c++;
                @endphp
              @endif

            @endforeach
          </tbody>
        </table>
      @else
        <p>No hay documentos registrados o sub proceso registrados</p>
      @endif
    @endforeach


</body>
</html>
