<table class="table table-hover">
  <thead class="thead-dark">
    <tr>
      <th scope="col" class="text-center" width="30px">#</th>      
      <th scope="col" class="text-center">Rol</th>
      <th width="70px" scope="col" class="text-center"><i class="fas fa-edit"></i></th>
      <th width="70px" scope="col" class="text-center"><i class="fas fa-trash"></i></th>
    </tr>
  </thead>
  <tbody>
    @if ($roles->count())
        @foreach ($roles as $key => $rol)
        <tr>
            <td scope="row">{{$key+1}}</td>
            <td class="text-center">{{$rol->name}}</td>
            <td>    </td>
            <td>    </td>
        </tr>
        @endforeach
    @else
        <p class="card-text"><strong>{{ucfirst(__('Not results found for :data', ['data' => $search]))}}
        @if ($page>1)
        {{mb_strtolower(__('on page :data', ['data' => $page]),'UTF-8')}}</strong></p>
        @else
            </strong></p>    
        @endif
    @endif    
  </tbody>  
</table>
