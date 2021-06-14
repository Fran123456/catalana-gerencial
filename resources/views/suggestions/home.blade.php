<x-app-layout>
 @include('suggestions.navigation')

<br>
<div class="container">
  @can('suggestions_estrategic')
    <div class="row">
      <div class="text-center">
        <h4>REPORTES ESTRATEGICOS</h4>
      </div>
      <div class="col-md-4">
        <div class="card ">
          <div class="mt-3 text-center">
            <span style="font-size: 48px;" class="text-primary">
            <i class="fas fa-envelope-open fa-2x"></i>
          </span>
          </div>
            <div class="text-center card-body">
              <h5 class="card-title">Sugerencias realizadas por tipo</h5>
              <!--<p class="card-text">
                Cantidad de sugerencias por tipo realizadas por año (Se puede realizar comparativas de varios años)
              </p>-->
              <div>
                  @include('suggestions.modals.suggestions-type-modal')
              </div>
            </div>
        </div>
      </div>
    </div>
  @endcan
  <br>

  @can('suggestions_tactical')
    <div class="row">
      <div class="text-center">
        <h4>REPORTES TACTICOS</h4>
      </div>
      <div class="col-md-4">
        <div class="card ">
          <div class="mt-3 text-center">
            <span style="font-size: 48px;" class="text-primary">
            <i class="fas fa-envelope-open fa-2x"></i>
          </span>
          </div>
            <div class="text-center card-body">
              <h5 class="card-title">Sugerencias realizadas por fechas</h5>
              <div>
                  @include('suggestions.modals.suggestions-date-modal')
              </div>
            </div>
        </div>
      </div>
    </div>
  @endcan

  @if (auth()->user()->can('suggestions_estrategic') == false && auth()->user()->can('suggestions_tactical') == false)
  <div class="row">
      <div class="text-center">
        <h4>SIN PERMISOS</h4>
      </div>
    </div>
  @endif
</div>




</x-app-layout>
