<div> 
  <div class="col-md-12">
    <div class="row mb-2">                  
      <div class="col-md-12">
        <input type="text"  class="form-control" placeholder="{{__('Search')}}" wire:model="search_role" />
      </div>              
    </div>
  </div>
    <div class="col-md-12">
      @include('livewire.roles.table-roles')    
    </div>
    <div class="text-center">
      {{$roles->links()}}
    </div>
</div>
