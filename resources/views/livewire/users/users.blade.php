<div>
  <script type="text/javascript">
    Livewire.on('send',() => {
        $('#exampleModal').modal('hide');
        $('.modal-backdrop').removeClass('show');
        $('.modal-backdrop').addClass('hide');

        $('.modal').removeClass('show');
        $('.modal').addClass('hide');

        setTimeout(function(){$("#message").fadeOut('slow');}, 2000);
    })
  </script>


  <div class="col-md-12">
    @if (session()->has('message'))
        <div class="alert alert-success" id="message">
          {{ __(session('message') , ['data'=> 'Usuario']) }}
        </div>
    @endif
  </div>
  <!--form add users-->
  <div class="col-md-12 text-right">
    @include('livewire.users.create-user')
  </div>
  <!--form add users-->
  <!--table-->
  <div class="col-md-12">
    @include('livewire.users.table-users')
  </div>
  <!--table-->


</div>
