<!-- Button trigger modal -->
<button
  type="button"
  class="btn btn-primary"
  data-mdb-toggle="modal"
  data-mdb-target="#training-scores">
  <i class="fas fa-chevron-circle-right"></i>
</button>

<!-- Modal -->
<div
  class="modal fade"
  id="training-scores"
  tabindex="-1"
  aria-labelledby="exampleModalLabel"
  aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Empleados aprobados y reprobados por capacitación</h5>
        <button type="button"class="btn-close"  data-mdb-dismiss="modal"aria-label="Close"></button>
      </div>
      <div class="modal-body">
        {{--<div class="row">
          <div class="col-md-6 text-left">
            <label for="">Año inicial</label>
            <input id="datei-date" class="form-control" required type="number" min="2000"  name="" value="{{$help::yearToday()}}">
          </div>
          <div class="col-md-6 text-left">
            <label for="">Año final</label>
            <input id="datef-date" class="form-control" required type="number" min="2000"  name="" value="{{$help::yearToday()}}">
          </div>
        </div>
        <br>--}}
        <div class="row">
            <div class="col-md-12 text-left">
                <label for="">Capacitación</label>
                <select required class="form-control" name="" id="option-type">                
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
        <button type="button" class="btn btn-success" onclick="reporte1('excel')" name="button"><i class="fas fa-file-excel fa-2x"></i></button>

        <button type="button" class="btn btn-danger" onclick="reporte1('pdf')" name="button"><i class="fas fa-file-pdf fa-2x"></i></button>
      </div>
    </div>
  </div>
</div>

<script type="text/javascript">
function reporte1(type){
 //var datei =  $("#datei-date").val();
 //var datef  = $("#datef-date").val();
    var trainingId =$("#option-type").val();
    window.open("{{$help::url()}}training/reports/tactical/r5/" +type+"/"+trainingId, "_blank");
  return false;
 /*if(datei==null ||datei == "")datei = "no";
 if(datef==null ||datef == "")datef= "no";
    window.open("{{$help::url()}}training/reports/tactical/r4/" +type+"/"+datei+"/"+datef, "_blank");
   return false;*/
 }
</script>
