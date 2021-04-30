<table class="table">
  <thead class="thead-dark">
    <tr>
      <th scope="col" class="text-center">#</th>
      <th scope="col" class="text-center">{{__('name')}}</th>
      <th scope="col" class="text-center">{{__('email')}}</th>
      <th scope="col" class="text-center">{{__('photo')}}</th>
      <th scope="col" class="text-center"><i class="fas fa-edit"></i></th>
    </tr>
  </thead>
  <tbody>
    @foreach ($users as $key => $user)
      <tr>
        <th scope="row">{{$key+1}}</th>
        <td>{{$user->name}}</td>
        <td>{{$user->email}}</td>
        <td>{{$user->profile_photo_url}}</td>
        <td> <button type="button" class="btn btn-warning"><i class="fas fa-edit"></i></button> </td>
      </tr>
    @endforeach
  </tbody>
</table>
{{$users->links()}}
