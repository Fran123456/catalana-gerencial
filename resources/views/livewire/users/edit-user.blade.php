<!-- Button trigger modal -->


  <div  wire:ignore.self  class="modal fade" id="exampleModal-edit" tabindex="-1"  aria-labelledby="exampleModalLabel"aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">{{__('Update user')}} </h5>
        </div>
        <div class="modal-body">
          <input type="text" name="" hidden value="{{$idUser}}" wire:model="idUser">
          <!-- name input -->
            <div class="mb-4">
              <input wire:model="name" value="{{$name}}" placeholder="{{__('name')}}" type="text" class="form-control" />
              @error('name') <span class="text-danger">{{$message}}</span> @enderror
            </div>

          <!-- Email input -->
            <div class="mb-4">
              <input readonly wire:model="email"  value="{{$email}}" placeholder="{{__('email')}}" type="email" class="form-control" />
              @error('email') <span>{{$message}}</span> @enderror
            </div>

        </div>
        <div class="modal-footer">
          <button wire:click.prevent="update()"  data-bs-dismiss="modal"  class="btn btn-primary"><i class="fas fa-save"></i></button>
        </div>
      </div>
    </div>
  </div>
