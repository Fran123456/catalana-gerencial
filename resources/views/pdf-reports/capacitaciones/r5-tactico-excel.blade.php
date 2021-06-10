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
            <td><strong>Reporte de empleados aprobados y reprobados de una capacitación</strong></td>
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
        <tr><td><strong>Aprobados</strong></td></tr>
        <tr>
            <th><strong>#</strong></th>
            <th><strong>ID</strong></th>
            <th><strong>Empleado</strong></th>
            <th><strong>Nota</strong></th>
            <th><strong>Empresa</strong></th>
            <th><strong>Área</strong></th>
            <th><strong>Depto.</strong></th>
            <th><strong>Cargo</strong></th>
        </tr>
    </thead>
    <tbody> 
        @if ($aprobados->count() == 0)
            <tr><td><p>No se encontraron registros</p></td></tr>                
        @else
            @foreach ($aprobados as $num => $apr)
                <tr>
                    <td>{{$num+1}}</td>
                    <td>{{$apr->employee->id}}</td>
                    <td>{{$apr->employee->names}} {{$apr->employee->lastnames}}</td>                        
                    @if ($apr->score == NULL)
                        <td>Sin Nota</td>
                    @else
                        <td>{{$apr->score}}</td>
                    @endif                                    
                    <td>{{$apr->employee->enterprise->enterprise}}</td>
                    <td>{{$apr->employee->area->area}}</td>
                    <td>{{$apr->employee->department->department}}</td>
                    <td>{{$apr->employee->position->position}}</td>
                </tr>
            @endforeach
            @php
                $aprobados = null;
            @endphp
        @endif                                   
    </tbody>
</table>                
            
<table>
    <thead>
        <tr>
            <th><strong>Reprobados</strong></th>
        </tr>
        <tr>
            <th><strong>#</strong></th>
            <th><strong>ID</strong></th>
            <th><strong>Empleado</strong></th>
            <th><strong>Nota</strong></th>
            <th><strong>Empresa</strong></th>
            <th><strong>Área</strong></th>
            <th><strong>Depto.</strong></th>
            <th><strong>Cargo</strong></th>
        </tr>
    </thead>                        
    <tbody>
        @if ($reprobados->count() == 0)
            <tr><td><p>No se encontraron registros</p></td></tr>                
        @else
            @foreach ($reprobados as $num => $repr)                
                <tr>
                    <td>{{$num+1}}</td>
                    <td >{{$repr->employee->id}}</td>
                    <td >{{$repr->employee->names}} {{$repr->employee->lastnames}}</td>
                    @if ($repr->score == NULL)
                        <td>Sin Nota</td>
                    @else
                        <td>{{$repr->score}}</td>
                    @endif                                    
                    <td>{{$repr->employee->enterprise->enterprise}}</td>
                    <td>{{$repr->employee->area->area}}</td>
                    <td>{{$repr->employee->department->department}}</td>
                    <td>{{$repr->employee->position->position}}</td>
                </tr>
            @endforeach
            @php
                $reprobados = null;
            @endphp
        @endif            
    </tbody>
</table>  

<table>
    <thead>
        <tr>
            <th><strong>Sin nota</strong></th>
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
        @if ($sin_nota->count() == 0)
            <tr><td><p>No se encontraron registros</p></td></tr>                
        @else
            @foreach ($sin_nota as $num => $none)                
                <tr>
                    <td>{{$num+1}}</td>
                    <td >{{$none->employee->id}}</td>
                    <td >{{$none->employee->names}} {{$none->employee->lastnames}}</td>                                                  
                    <td>{{$none->employee->enterprise->enterprise}}</td>
                    <td>{{$none->employee->area->area}}</td>
                    <td>{{$none->employee->department->department}}</td>
                    <td>{{$none->employee->position->position}}</td>
                </tr>
            @endforeach
            @php
                $sin_nota = null;
            @endphp
        @endif            
    </tbody>
</table>