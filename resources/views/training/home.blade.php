<x-app-layout>
 @include('training.navigation')

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
          <i class="fas fa-chalkboard-teacher fa-2x"></i>
         </span>
        </div>
          <div class="card-body text-center">
             <h5 class="card-title">Promedio de notas por capacitación por periodo</h5>
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
        <div class="text-center mt-3">
          <span style="font-size: 48px;" class="text-primary">
          <i class="fas fa-chalkboard-teacher fa-2x"></i>
         </span>
        </div>
          <div class="card-body text-center">
             <h5 class="card-title">Cuestionarios respondidos y no respondidos por periodo</h5>
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
        <div class="text-center mt-3">
          <span style="font-size: 48px;" class="text-primary">
          <i class="fas fa-chalkboard-teacher fa-2x"></i>
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

  <br>

  <div class="row">
    <div class="text-center">
      <h4>REPORTES TACTICOS</h4>
    </div>
    <div class="col-md-4">
      <div class="card ">
        <div class="text-center mt-3">
          <span style="font-size: 48px;" class="text-primary">
          <i class="fas fa-chalkboard-teacher fa-2x"></i>
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
          <i class="fas fa-chalkboard-teacher fa-2x"></i>
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
          <i class="fas fa-chalkboard-teacher fa-2x"></i>
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
</div>




</x-app-layout>
