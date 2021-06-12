<x-app-layout>

<div class="row">
    {{--<div class="col-md-4">
        <livewire:data.data/>
    </div>--}}

    <div class="col-md-4">
      <div class="card ">
        <div class="text-center mt-3">
          <span style="font-size: 48px;" class="text-primary">          
          <i class="fas fa-clipboard-list fa-2x"></i>
         </span>
        </div>
          <div class="card-body text-center">
             <h5 class="card-title">BITÁCORA</h5>
             <p class="card-text">
             </p>
             <div>
                @include('system.modals.filter-date-modal')
             </div>
          </div>
      </div>
    </div>


    
</x-app-layout>
