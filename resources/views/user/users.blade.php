<x-app-layout>
<<<<<<< HEAD
<div class="container">
  <div class="row">
    @livewire('Users.Users')
  </div>
</div>

=======

  <div class="row card">
    <!--componente de usuarios-->
      <div class="card-header"> <strong>{{strtoupper(__('manage users'))}}</strong>  </div>
      <div class="card-body">
        <p class="card-text">
          <livewire:users.users/>
        </p>
      </div>
    <!--componente de usuarios-->
  </div>
>>>>>>> 7142dc6edcdc397893db6440e88cd16fa3938d7d

</x-app-layout>
