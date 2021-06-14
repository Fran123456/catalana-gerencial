<table>
    <thead>
        <tr>                        
        </tr>
    </thead>
    <tbody>
        <tr>
            <td></td>
            <td></td>
            <td></td>
            <td><strong>Reporte de las publicaciones realizadas por un año</strong></td>
        </tr>
        <tr></tr>
        <tr></tr>
    </tbody>
</table>

    

<table>
    <thead>
        <tr>
            <td><strong>Publicacion</strong></td>
                <td>{{$publicacion->title}}</td>                  
        </tr>
        <tr>
            <td><strong>Tipo</strong></td>
                <td>{{$publicacion->type}}</td>                  
        </tr>
        <tr>
            <td><strong>Año</strong></td>
                <td>{{strval($publicacion->year)}}</td>                  
        </tr>
        <tr><td></td></tr>
        <tr>
            <th><strong>#</strong></th>
            <th><strong>Empleado</strong></th>                                
            <th><strong>DUI</strong></th>
            <th><strong>Empresa</strong></th>
            <th><strong>Área</strong></th>
            <th><strong>Vista</strong></th>
        </tr>
    </thead>
    <tbody> 
        @if ($publicacion->empleados->count() == 0)
            <tr><td><p>No se encontraron registros</p></td></tr>                
        @else
            @foreach ($publicacion->empleados as $id => $empleado)
            <tr>
                <td>{{$loop->iteration}}</td>
                <td>{{$empleado->names}} {{$empleado->lastnames}}</td>
                <td>{{$empleado->dui}}</td>
                <td>{{$empleado->enterprise->enterprise}}</td>
                <td>{{$empleado->area->area}}</td>
                <td>{{($empleado->detalle->seen ? 'SI' : 'NO')}}</td>
            </tr>
            @endforeach
        @endif                                   
    </tbody>
</table>   
