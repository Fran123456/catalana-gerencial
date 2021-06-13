<table>
    <thead>
      <th></th>
      <th></th>
    </thead>
    <tbody>
        <tr>
          <td colspan="3" ><img src="images/logos/catalana.jpg" height="50px" width="150px" alt=""></td>
          <td colspan="4"><strong>Reporte de publicaciones realizadas en un año</strong> </td>
        </tr>
    </tbody>
</table>

<table >
  <thead>
    <tr>
        <td style="color: white;">&nbsp;</td>  <td style="color: white;">&nbsp;</td>   <td style="color: white;">&nbsp;</td>
        <td><strong>Año</strong></td>
        <td>{{$year}}</td>                  
    </tr>
    <tr>
        <td style="color: white;">&nbsp;</td>  <td style="color: white;">&nbsp;</td>   <td style="color: white;">&nbsp;</td>
        <td><strong># de publicaciones</strong></td>
        <td>{{$publicaciones->count()}}</td>                  
    </tr>
    <tr></tr>
    <tr>
      <th></th>
      <th></th>
      <th ></th>
      <th><strong>#</strong></th>
      <th><strong>Publicacion</strong></th>
      <th><strong>Tipo</strong></th>
      <th><strong>Población</strong></th>
    </tr>
  </thead>
  <tbody>
    @foreach ($publicaciones as $publicacion)
       <tr>
        <td style="color: white;">&nbsp;</td>  <td style="color: white;">&nbsp;</td>   <td style="color: white;">&nbsp;</td>
         <td>{{$loop->iteration}}</td>
         <td >{{$publicacion->title}}</td>
         <td>{{$publicacion->type}}</td>
         <td>{{strval($publicacion->empleados->count())}}</td>
       </tr>
       @endforeach 
  </tbody>
</table>
