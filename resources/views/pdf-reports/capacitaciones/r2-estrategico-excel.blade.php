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
