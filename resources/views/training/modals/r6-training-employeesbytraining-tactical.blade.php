<!-- Button trigger modal -->
<button
  type="button"
  class="btn btn-primary"
  data-mdb-toggle="modal"
  data-mdb-target="#training-employees">
  <i class="fas fa-chevron-circle-right"></i>
</button>

<!-- Modal -->
<div
  class="modal fade"
  id="training-employees"
  tabindex="-1"
  aria-labelledby="exampleModalLabel"
  aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Empleados por capacitación</h5>
        <button type="button"class="btn-close"  data-mdb-dismiss="modal"aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <div class="row">
            <div class="col-md-12 text-left">
                <label for="">Capacitación</label>
                <select required class="form-control" name="" id="option-type-r6">
                    @foreach ($trainings as $key => $training)
                      <option value="{{$training->id}}">{{$training->training}}</option>
                    @endforeach
                    <option value="0">TODAS</option>
                </select>
          </div>
        </div>

      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-primary" data-mdb-dismiss="modal">
          <i class="fas fa-window-close fa-2x"></i>
        </button>
        <button type="button" class="btn btn-success" onclick="reporte6('excel')" name="button"><i class="fas fa-file-excel fa-2x"></i></button>

        <button id='pdfr6' type="button" class="btn btn-danger" onclick="reporte6('pdf')" name="button"><i class="fas fa-file-pdf fa-2x"></i></button>
      </div>
    </div>
  </div>
</div>

<script type="text/javascript">

function reporte6(type){
    var trainingId =$("#option-type-r6").val();
    window.open("{{$help::url()}}training/reports/tactical/r6/" +type+"/"+trainingId, "_blank");
  return false;
 }

          $("#option-type-r6").on('change', function (){
            var x = $('#option-type-r6').val();
            if(x==0){
              $('#pdfr6').prop('disabled', true);
            }else{
              $('#pdfr6').prop('disabled',false);
            }
         });



</script>
