<x-app-layout>

  <div class="row">
    <div class="col-md-4">
        <livewire:data.data/>
    </div>

    <div class="col-md-4">
      <div class="card ">
        <div class="text-center mt-3">
          <span style="font-size: 48px;" class="text-primary">
          <i class="fas fa-sitemap fa-2x"></i>
         </span>
        </div>
          <div class="card-body text-center">
             <h5 class="card-title">CAPACITACIONES</h5>
             <p class="card-text">
             </p>
             <div wire:loading.remove>
                <a  class="btn btn-primary"><i class="fas fa-chevron-circle-right"></i></a>
             </div>
          </div>
      </div>
    </div>


    <div class="col-md-4">
      <div class="card ">
        <div class="text-center mt-3">
          <span style="font-size: 48px;" class="text-primary">
          <i class="fas fa-chalkboard fa-2x"></i>
         </span>
        </div>
          <div class="card-body text-center">
             <h5 class="card-title">PUBLICACIONES</h5>
             <p class="card-text">
             </p>
             <div wire:loading.remove>
                <a  class="btn btn-primary"><i class="fas fa-chevron-circle-right"></i></a>
             </div>
          </div>
      </div>
    </div>


  </div>
  <br>
  <div class="row">
    <div class="col-md-4">
      <div class="card ">
        <div class="text-center mt-3">
          <span style="font-size: 48px;" class="text-primary">
          <i class="fas fa-envelope-open fa-2x"></i>
         </span>
        </div>
          <div class="card-body text-center">
             <h5 class="card-title">BUZON SUGERENCIAS</h5>
             <p class="card-text">
             </p>
             <div wire:loading.remove>
                <a  class="btn btn-primary"><i class="fas fa-chevron-circle-right"></i></a>
             </div>
          </div>
      </div>
    </div>
  </div>



</x-app-layout>
