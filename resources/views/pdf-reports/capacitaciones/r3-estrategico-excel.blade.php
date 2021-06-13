<table class="table table-light">
    <thead class="thead-light">
        <tr>
            <th>Año</th>
            <th>Capacitacion</th>

        </tr>
    </thead>
    <tbody>
       @foreach ($data as $item)

         <tr>
             <td>{{$item->year}}</td>
             <td>{{$item->capacitacion}}</td>

         </tr>
       @endforeach
    </tbody>
</table>
