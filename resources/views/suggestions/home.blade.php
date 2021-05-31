<x-app-layout>
 @include('suggestions.navigation')

<br>
<div class="container">
  <div class="row">
    <div class="text-center">
      <h4>REPORTES ESTRATEGICOS</h4>
    </div>
    <div class="col-md-4">
      <div class="card ">
        <div class="text-center mt-3">
          <span style="font-size: 48px;" class="text-primary">
          <i class="fas fa-envelope-open fa-2x"></i>
         </span>
        </div>
          <div class="card-body text-center">
             <h5 class="card-title">Sugerencias realizadas por tipo</h5>
             <!--<p class="card-text">
               Cantidad de sugerencias por tipo realizadas por año (Se puede realizar comparativas de varios años)
             </p>-->
             <div>
                @include('suggestions.modals.sugerencias-tipo-modal')
             </div>
          </div>
      </div>
    </div>
  </div>
</div>




</x-app-layout>
