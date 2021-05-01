<table class="table">
  <thead class="thead-dark">
    <tr>
      <th scope="col" class="text-center" width="40px">#</th>
      <th scope="col" class="text-center">{{ strtoupper(__('name')) }}</th>
      <th scope="col" class="text-center">{{ strtoupper(__('email')) }}</th>
      <th width="70px" scope="col" class="text-center"><i class="fas fa-edit"></i></th>
      <th width="70px" scope="col" class="text-center"><i class="fas fa-trash"></i></th>
    </tr>
  </thead>
  <tbody>
    @foreach ($users as $key => $user)
      <tr>
        <th scope="row">{{$key+1}}</th>
        <td><img height="40" width="40" src="{{$user->profile_photo_url}}" class="img-thumbnail"> {{$user->name}}</td>
        <td>{{$user->email}}</td>
        <td class="text-center" >
          <button type="button" wire:click="getUser({{$user->id}})"  class="btn btn-warning" data-mdb-toggle="modal" data-mdb-target="#exampleModal-edit">
            <i class="fas fa-edit"></i>
          </button>
        </td>
        <td class="text-center" >
          @if (Auth::user()->id == $user->id)
            <button disabled  type="button" class="btn btn-danger"><i class="fas fa-trash"></i>
            </button>
          @else
            <button wire:click="getUser({{$user->id}})" data-mdb-toggle="modal" data-mdb-target="#exampleModal-delete" type="button" class="btn btn-danger"><i class="fas fa-trash"></i>
            </button>
          @endif

        </td>
      </tr>
    @endforeach
  </tbody>
</table>
