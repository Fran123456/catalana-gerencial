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
            <td><strong>Reporte de empleados que resuelven o no una capacitación</strong></td>            
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
        <tr><td><strong>Realizados</strong></td></tr>
        <tr>
            <th><strong>#</strong></th>
            <th><strong>ID</strong></th>
            <th><strong>Empleado</strong></th>
            <th><strong>Fecha</strong></th>
            <th><strong>Empresa</strong></th>
            <th><strong>Área</strong></th>
            <th><strong>Depto.</strong></th>
            <th><strong>Cargo</strong></th>
        </tr>
    </thead>
    <tbody> 
        @if ($tomados->count() == 0)
            <tr><td><p>No se encontraron registros</p></td></tr>                
        @else
            @foreach ($tomados as $num => $apr)
                <tr>
                    <td>{{$num+1}}</td>
                    <td>{{$apr->employee->id}}</td>
                    <td>{{$apr->employee->names}} {{$apr->employee->lastnames}}</td>
                    @if ($apr->date == NULL)
                        <td >Sin fecha</td>
                    @else
                        <td >{{$apr->date}}</td>
                    @endif                         
                    <td>{{$apr->employee->enterprise->enterprise}}</td>
                    <td>{{$apr->employee->area->area}}</td>
                    <td>{{$apr->employee->department->department}}</td>
                    <td>{{$apr->employee->position->position}}</td>           
                </tr>
            @endforeach
            @php
                $tomados = null;
            @endphp
        @endif                                   
    </tbody>
</table>                
            
<table>
    <thead>
        <tr>
            <th><strong>No realizados</strong></th>
        </tr>
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
        @if ($no_tomados->count() == 0)
            <tr><td><p>No se encontraron registros</p></td></tr>                
        @else
            @foreach ($no_tomados as $num => $repr)                
                <tr>
                    <td>{{$num+1}}</td>
                    <td>{{$repr->employee->id}}</td>
                    <td>{{$repr->employee->names}} {{$repr->employee->lastnames}}</td>
                    <td>{{$repr->employee->enterprise->enterprise}}</td>
                    <td>{{$repr->employee->area->area}}</td>
                    <td>{{$repr->employee->department->department}}</td>
                    <td>{{$repr->employee->position->position}}</td>
                </tr>
            @endforeach
            @php
                $no_tomados = null;
            @endphp
        @endif            
    </tbody>
</table>