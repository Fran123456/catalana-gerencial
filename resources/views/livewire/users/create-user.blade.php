<div class="">
  <!-- Button trigger modal -->
  <button type="button" livewire:click="store" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal">
    <i class="fas fa-user"></i>
  </button>

  <!-- Modal -->
  <div wire:ignore.self class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">{{__('New user')}}</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <!-- name input -->
            <div class="mb-4">
              <input wire:model="name"  placeholder="{{__('name')}}" type="text" class="form-control" />
              @error('name') <span>{{$message}}</span> @enderror
            </div>

          <!-- Email input -->
            <div class="mb-4">
              <input wire:model="email"  placeholder="{{__('email')}}" type="email" class="form-control" />
              @error('email') <span>{{$message}}</span> @enderror
            </div>

            <!-- Password input -->
            <div class=" mb-4">
              <input wire:model="password" placeholder="{{__('password')}}" type="password"  class="form-control" />
              @error('password') <span>{{$message}}</span> @enderror
            </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal"><i class="fas fa-window-close"></i></button>
          <button wire:click.prevent="store()"  data-bs-dismiss="modal"  class="btn btn-primary"><i class="fas fa-save"></i></button>
        </div>
      </div>
    </div>
  </div>
</div>
