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
            <td><strong>REPORTE DE BITÁCORA DEL SISTEMA</strong></td>
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
        </tr>
        <tr>                          
            @if ($start_date == 'no')
                <td>No ingresada</td>
            @else
                <td>{{$start_date}}</td>
            @endif
            @if ($end_date == 'no')
                <td>No ingresada</td>
            @else
                <td>{{$end_date}}</td>
            @endif                                
        </tr>
    </tbody>
</table>

<table>
    <thead>
        <tr>
            <th><strong>#</strong></th>    
            <th><strong>Id</strong></th>
            <th><strong>Usuario</strong></th>
            <th><strong>Descripción</strong></th>
            <th><strong>Ruta</strong></th>
            <th><strong>Fecha</strong></th>                        
        </tr>
    </thead>
    <tbody>                              
    @if ($query->count() == 0)        
        <tr><td><p>No se encontraron sugerencias con los parámetros ingresados</p></td></tr>        
    @else
        @foreach ($query as $key => $row)
            <tr>
                <td>{{$key + 1}}</td>
                <td>{{$row->causer_id}}</td>
                <td>{{$row->name}}</td>
                <td>{{$row->description}}</td>
                <td>{{$row->log_name}}</td>
                <td>{{$row->created_at}}</td>
            </tr>
        @endforeach
    @endif
    </tbody>
</table>