<x-app-layout>
 @include('publications.navigation')

<br>
<div class="container">
  @can('publications_estrategic')      
    <div class="row">
      <div class="text-center">
        <h4>REPORTES ESTRATÉGICOS</h4>
      </div>
      <div class="col-md-4">
        <div class="card ">
          <div class="text-center mt-3">
            <span style="font-size: 48px;" class="text-primary">
            <i class="fas fa-newspaper fa-2x"></i>
          </span>
          </div>
            <div class="card-body text-center">
              <h5 class="card-title">Reporte de publicaciones realizadas por año</h5>
              <div>
                  @include('publications.modals.published-modal')
              </div>
            </div>
        </div>
      </div>

      <div class="col-md-4">
        <div class="card ">
          <div class="text-center mt-3">
            <span style="font-size: 48px;" class="text-primary">
            <i class="fas fa-newspaper fa-2x"></i>
          </span>
          </div>
            <div class="card-body text-center">
              <h5 class="card-title">Reporte de alcance de las publicaciones por año</h5>
              <div>
                  @include('publications.modals.reach-modal')
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
        <h4>REPORTES TÁCTICOS</h4>
      </div>
      <div class="col-md-4">
        <div class="card ">
          <div class="text-center mt-3">
            <span style="font-size: 48px;" class="text-primary">
            <i class="fas fa-newspaper fa-2x"></i>
          </span>
          </div>
            <div class="card-body text-center">
              <h5 class="card-title">Reporte de personas que han visto o no una publicación</h5>
              <div>
                  @include('publications.modals.seen-modal')
              </div>
            </div>
        </div>
      </div>
    </div>
  @endcan

  @if (auth()->user()->can('publications_estrategic') == false && auth()->user()->can('publications_tactical') == false)
  <div class="row">
      <div class="text-center">
        <h4>SIN PERMISOS</h4>
      </div>      
    </div>
  @endif  
</div>
</x-app-layout>
