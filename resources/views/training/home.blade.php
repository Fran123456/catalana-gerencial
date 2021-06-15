<x-app-layout>
 @include('training.navigation')

<br>
<div class="container">

  @can('trainings_estrategic')
  <div class="row">
    <div class="text-center">
      <h4>REPORTES ESTRATÉGICOS</h4>
    </div>
    <div class="col-md-4">
      <div class="card ">
        <div class="mt-3 text-center">
          <span style="font-size: 48px;" class="text-primary">
          <i class="fas fa-chalkboard-teacher fa-2x"></i>
         </span>
        </div>
          <div class="text-center card-body">
             <h5 class="card-title">Reporte de promedio de notas por capacitación por periodo</h5>
             <!--<p class="card-text">
               Cantidad de sugerencias por tipo realizadas por año (Se puede realizar comparativas de varios años)
             </p>-->
             <div>
                @include('training.modals.r1-training-scorebytraining-strategic')
             </div>
          </div>
      </div>
    </div>

    <div class="col-md-4">
      <div class="card ">
        <div class="mt-3 text-center">
          <span style="font-size: 48px;" class="text-primary">
          <i class="fas fa-chalkboard-teacher fa-2x"></i>
         </span>
        </div>
          <div class="text-center card-body">
             <h5 class="card-title">Reporte de estadísticas de capacitaciones por periodo</h5>
             <!--<p class="card-text">
               Cantidad de sugerencias por tipo realizadas por año (Se puede realizar comparativas de varios años)
             </p>-->
             <div>
             @include('training.modals.r2-training-quiz-number-strategic')
             </div>
          </div>
      </div>
    </div>


    <div class="col-md-4">
      <div class="card ">
        <div class="mt-3 text-center">
          <span style="font-size: 48px;" class="text-primary">
          <i class="fas fa-chalkboard-teacher fa-2x"></i>
         </span>
        </div>
          <div class="text-center card-body">
             <h5 class="card-title">Reporte de capacitaciones realizadas por periodo</h5>
             <!--<p class="card-text">
               Cantidad de sugerencias por tipo realizadas por año (Se puede realizar comparativas de varios años)
             </p>-->
             <div>
                @include('training.modals.r3-training-number-strategic')
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
          <div class="mt-3 text-center">
            <span style="font-size: 48px;" class="text-primary">
            <i class="fas fa-chalkboard-teacher fa-2x"></i>
          </span>
          </div>
            <div class="text-center card-body">
              <h5 class="card-title">Reporte de empleados que resuelven y no una capacitación</h5>
              <div>
                  @include('training.modals.r4-training-submittedtraining-tactical')
              </div>
            </div>
        </div>
      </div>


      <div class="col-md-4">
        <div class="card ">
          <div class="mt-3 text-center">
            <span style="font-size: 48px;" class="text-primary">
            <i class="fas fa-chalkboard-teacher fa-2x"></i>
          </span>
          </div>
            <div class="text-center card-body">
              <h5 class="card-title">Reporte de lista de notas de empleados aprobados y reprobados por capacitación</h5>
              <div>
                @include('training.modals.r5-training-scores-tactical')
              </div>
            </div>
        </div>
      </div>

      <div class="col-md-4">
        <div class="card ">
          <div class="mt-3 text-center">
            <span style="font-size: 48px;" class="text-primary">
            <i class="fas fa-chalkboard-teacher fa-2x"></i>
          </span>
          </div>
            <div class="text-center card-body">
              <h5 class="card-title">Reporte de todos los empleados de una capacitación</h5>
              <div>
                @include('training.modals.r6-training-employeesbytraining-tactical')
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
