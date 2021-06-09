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
            <td><strong>Reporte de todos los empleados de una capacitación</strong></td>
        </tr>
        <tr></tr>
        <tr></tr>
    </tbody>
</table>

    

<table>
    <thead>
        <tr>            
            <td><strong>Capacitación</strong></td>
            <td><strong>{{$query->training}}</strong></td>
        </tr>
        <tr><td></td></tr>
        <tr>
            <th><strong>#</strong></th>
            <th><strong>ID</strong></th>
            <th><strong>Empleado</strong></th>                
            <th><strong>Empresa</strong></th>
            <th><strong>Área</strong></th>
            <th><strong>Depto.</strong></th>
            <th><strong>Cargo</strong></th>
        </tr>
    </thead>
    <tbody> 
        @if ($empleados->count() == 0)
            <tr><td><p>No se encontraron registros</p></td></tr>                
        @else
            @foreach ($empleados as $num => $apr)
                <tr>
                    <td>{{$num+1}}</td>
                    <td>{{$apr->id}}</td>
                    <td>{{$apr->name}} {{$apr->lastname}}</td>
                    <td>{{$apr->enterprise}}</td>
                    <td>{{$apr->area}}</td>
                    <td>{{$apr->department}}</td>
                    <td>{{$apr->position}}</td>
                </tr>
            @endforeach
            @php
                $empleados = null;
            @endphp
        @endif                                   
    </tbody>
</table>   
