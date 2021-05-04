<div> 
  <div class="col-md-12">

  @if (session()->has('message'))
      <div class="alert alert-success" id="message">
        {{ __(session('message') , ['data'=> ucfirst(__('role'))]) }}
      </div>
  @endif

  @if (session()->has('message-destroy'))
      <div class="alert alert-danger" id="message-destroy">
        {{ __(session('message-destroy') , ['data'=> ucfirst(__('role'))]) }}
      </div>
  @endif

  @if (session()->has('message-update'))
      <div class="alert alert-warning" id="message-update">
        {{ __(session('message-update') , ['data'=> ucfirst(__('role')) ]) }}
      </div>
  @endif
  </div>
  <div class="col-md-12">
    <div class="row mb-2">                  
      <div class="col-md-11">
        <input type="text"  class="form-control" placeholder="{{__('Search')}}" wire:model="search_role" />
      </div>              
      <div class="col-md-1">
        <button type="button" wire:click="clean" class="btn btn-primary mb-2" data-toggle="modal" data-target="#exampleModal">
          <i class="fas fa-plus"></i>
        </button>
      </div>
    </div>
  </div>
    <div class="col-md-12">
      @include('livewire.roles.table-roles')    
    </div>
    <div class="text-center">
      {{$roles->links()}}
    </div>
    <div class="col-md-12">
      @include('livewire.roles.create-role')
      @include('livewire.roles.delete-role')
      @include('livewire.roles.edit-role')
    </div>    

    <script type="text/javascript">
    Livewire.on('send',() => {
        removeModal("#exampleModal");
        setTimeout(function(){$("#message").fadeOut('slow');}, 2000);
    })

    Livewire.on('destroy',() => {
      removeModal('#exampleModal-destroy');
      setTimeout(function(){$("#message-destroy").fadeOut('slow');}, 2000);
    })

    Livewire.on('update',() => {
      removeModal('#exampleModal-update');
      setTimeout(function(){$("#message-update").fadeOut('slow');}, 2000);
    })

     function removeModal(id){
      $(id).modal('hide');
      $('.modal-backdrop').removeClass('show');
      $('.modal-backdrop').addClass('hide');
      $('.modal').removeClass('show');
      $('.modal').addClass('hide');
    }
  </script>
</div>
