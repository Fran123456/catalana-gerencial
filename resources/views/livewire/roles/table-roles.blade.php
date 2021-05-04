<table class="table table-hover">
  <thead class="thead-dark">
    <tr>
      <th scope="col" class="text-center" width="30px">#</th>
      <th scope="col" class="text-center">{{strtoupper(__('role'))}}</th>
      <th scope="col" class="text-center">{{strtoupper(__('Assigned users'))}}</th>
      <th width="70px" scope="col" class="text-center"><i class="fas fa-edit"></i></th>
      <th width="70px" scope="col" class="text-center"><i class="fas fa-trash"></i></th>
    </tr>
  </thead>
  <tbody>
    @if ($roles->count())
        @foreach ($roles as $key => $role)
        <tr>
            <td scope="row">{{$key+1}}</td>
            <td class="text-center">{{$role->name}}</td>
            <td class="text-center">{{$role->conteo}}</td>
            <td class="text-center" >
              <button type="button" wire:click="getRole({{$role->id}})"  class="btn btn-warning" data-mdb-toggle="modal" data-mdb-target="#exampleModal-edit">
                <i class="fas fa-edit"></i>
              </button>
            </td>
            <td class="text-center" >
              @if ($role->conteo > 0)
                <button disabled type="button" class="btn btn-danger"><i class="fas fa-trash"></i></button>
              @else
                <button wire:click="getRole({{$role->id}})" data-mdb-toggle="modal" data-mdb-target="#exampleModal-delete" type="button" class="btn btn-danger">
                <i class="fas fa-trash"></i>
                </button>
              @endif
            </td>
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