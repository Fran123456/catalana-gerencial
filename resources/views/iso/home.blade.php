<x-app-layout>
 @include('iso.navigation')

<br>
<div class="container">


  @can('iso_tactical')
    <div class="row">
      <div class="text-center">
        <h4>REPORTES TÁCTICOS</h4>
      </div>
      <div class="col-md-4">
        <div class="card ">
          <div class="text-center mt-3">
            <span style="font-size: 48px;" class="text-primary">
            <i class="fas fa-file-download fa-2x"></i>
          </span>
          </div>
            <div class="card-body text-center">
              <h5 class="card-title">Reporte de procesos generados y documento activo </h5>
              <div>
                    @include('iso.modals.r1')
              </div>
            </div>
        </div>
      </div>


      <div class="col-md-4">
        <div class="card ">
          <div class="text-center mt-3">
            <span style="font-size: 48px;" class="text-primary">
            <i class="fas fa-file-download fa-2x"></i>
          </span>
          </div>
            <div class="card-body text-center">
              <h5 class="card-title">Reporte de tipos y sus procesos generados </h5>
              <div>
                  @include('iso.modals.r2')
              </div>
            </div>
        </div>
      </div>

      <div class="col-md-4">
        <div class="card ">
          <div class="text-center mt-3">
            <span style="font-size: 48px;" class="text-primary">
            <i class="fas fa-file-download fa-2x"></i>
          </span>
          </div>
            <div class="card-body text-center">
              <h5 class="card-title">Reporte de descargas por empleado</h5>
              <div>

              </div>
            </div>
        </div>
      </div>
    </div>
  @endcan


  @if (auth()->user()->can('iso_tactical') == false)
  <div class="row">
      <div class="text-center">
        <h4>SIN PERMISOS</h4>
      </div>
    </div>
  @endif

</div>
</x-app-layout>
