<x-app-layout>
 @include('iso.navigation')

<br>
<div class="container">

  @can('trainings_estrategic')
  <div class="row">
    <div class="text-center">
      <h4>REPORTES ESTRATÉGICOS</h4>
    </div>
    <div class="col-md-4">
      <div class="card ">
        <div class="text-center mt-3">
          <span style="font-size: 48px;" class="text-primary">
          <i class="fas fa-file-download fa-2x"></i>
         </span>
        </div>
          <div class="card-body text-center">
             <h5 class="card-title">Promedio de notas por capacitación por periodo</h5>
             <!--<p class="card-text">
               Cantidad de sugerencias por tipo realizadas por año (Se puede realizar comparativas de varios años)
             </p>-->
             <div>

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
             <h5 class="card-title">Estadisticas de capacitaciones por periodo</h5>
             <!--<p class="card-text">
               Cantidad de sugerencias por tipo realizadas por año (Se puede realizar comparativas de varios años)
             </p>-->
             <div>

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
             <h5 class="card-title">Reporte de capacitaciones realizadas por periodo</h5>
             <!--<p class="card-text">
               Cantidad de sugerencias por tipo realizadas por año (Se puede realizar comparativas de varios años)
             </p>-->
             <div>

             </div>
          </div>
      </div>
    </div>
  </div>
  @endcan

  <br>

  @can('trainings_tactical')
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
              <h5 class="card-title">Reporte de empleados que resuelven y no una capacitación</h5>
              <div>

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
              <h5 class="card-title">Reporte de lista de notas de empleados aprobados y reprobados por capacitación</h5>
              <div>

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
              <h5 class="card-title">Reporte de todos los empleados de una capacitación</h5>
              <div>

              </div>
            </div>
        </div>
      </div>
    </div>
  @endcan


  @if (auth()->user()->can('trainings_estrategic') == false && auth()->user()->can('trainings_tactical') == false)
  <div class="row">
      <div class="text-center">
        <h4>SIN PERMISOS</h4>
      </div>
    </div>
  @endif

</div>
</x-app-layout>
