<table>
    <thead>
      <th></th>
      <th></th>
    </thead>
    <tbody>
        <tr>
          <td colspan="3" ><img src="images/logos/catalana.jpg" height="50px" width="150px" alt=""></td>
          <td colspan="4"><strong>Reporte de empleados que resuelven o no una capacitación</strong> </td>
        </tr>
        <tr>
        </tr>
    </tbody>
</table>



<table >
  <thead>
    <tr>
      <th></th>
      <th></th>
      <th ></th>
      <th >#</th>
      <th>capacitación</th>
      <th >Periodo</th>
      <th>Promedio</th>
    </tr>
  </thead>
  <tbody>
    @for ($i=0; $i < count($scores); $i++)
       <tr>
         <td style="color: white;">x</td>  <td style="color: white;">x</td>   <td style="color: white;">x</td>
         <td>{{$i+1}}</td>
         <td >{{$scores[$i]['training']}}</td>
         <td>{{$scores[$i]['year']}}</td>
         <td>{{round($scores[$i]['score'], 2)}}</td>
       </tr>
    @endfor
  </tbody>
</table>
