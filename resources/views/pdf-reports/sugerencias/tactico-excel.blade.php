<table>
    <thead>
        <tr>            
            
        </tr>
    </thead>
    <tbody>
        <tr>
            <td></td>
            <td></td>
            <td><strong>REPORTE DE SUGERENCIAS REALIZADAS POR FECHA</strong></td>
        </tr>
        <tr></tr>
        <tr></tr>
    </tbody>
</table>

<table>
    <thead>
        <tr>
            <th><strong>Parámetros</strong></th>
        </tr>
    </thead>
    <tbody>
        <tr>            
            <th><strong>Fecha inicial</strong></th>
            <th><strong>Fecha final</strong></th>
            <th><strong>Tipo de sugerencia</strong></th>
        </tr>
        <tr>                          
            @if ($fi == 'no')
                <td>No ingresada</td>
            @else
                <td>{{Carbon\Carbon::createFromFormat('Y-m-d',$fi)->format('d-m-Y')}}</td>
            @endif
            @if ($ff == 'no')
                <td>No ingresada</td>
            @else
                <td>{{Carbon\Carbon::createFromFormat('Y-m-d',$ff)->format('d-m-Y')}}</td>
            @endif                    
            @if ($tipo == "TODAS")
                <td>{{$tipo}}</td>
            @else
                <td>{{$tipo->suggestion_type}}</td>
            @endif  
        </tr>
    </tbody>
</table>

<table>
    <thead>
        <tr>
            <th><strong>#</strong></th>
            @if ($tipo == "TODAS")
                <th><strong>Sugerencia</strong></th>
                <th><strong>Tipo de sugerencia</strong></th>
            @else
                <th><strong>Sugerencia</strong></th>
            @endif             
            <th><strong>Fecha</strong></th>
            <th><strong>Id Empleado</strong></th>
            <th><strong>Empleado</strong></th>
        </tr>
    </thead>
    <tbody>                              
    @if ($query->count() == 0)
        @if ($tipo == "TODAS")
        <tr><td><p>No se encontraron sugerencias con los parámetros ingresados</p></td></tr>
        @else
        <tr><td><p>No se encontraron sugerencias con los parámetros ingresados</p></td></tr>
        @endif    
    @else
        @foreach ($query as $key => $row)
            <tr>
                <td>{{$key + 1}}</td>
                <td>{{$row->suggestion}}</td>
                @if ($tipo == "TODAS")
                <td>{{$row->suggestion_type}}</td>
                @endif
                <td>{{Carbon\Carbon::createFromTimeString($row->date)->format('d-m-Y H:i:s')}}</td>
                <td>{{$row->employee_id}}</td>
                <td>{{$row->employee->names}} {{$row->employee->lastnames}}</td>
            </tr>
        @endforeach
    @endif
    </tbody>
</table>