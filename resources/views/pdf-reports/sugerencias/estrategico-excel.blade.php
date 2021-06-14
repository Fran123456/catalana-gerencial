<table class="table table-light">
    <tr>
         @if ($typeId == 0 )
         <td>Tipo: {{$tipo}}</td>

        @else
        <td>Tipo: {{$tipo->suggestion_type}}</td>

        @endif
    </tr>
    <thead class="thead-light">
        <tr>
            <th>Año</th>
            <th>Tipo</th>
            <th>Visualizaciones</th>

        </tr>
    </thead>
    <tbody>
       @foreach ($data as $item)

         <tr>
             <td>{{$item->year}}</td>
             <td>{{$item->tipo}}</td>
             <td>{{$item->lectura}}</td>

         </tr>
       @endforeach
    </tbody>
</table>
