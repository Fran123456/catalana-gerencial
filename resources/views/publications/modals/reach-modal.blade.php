<!-- Button trigger modal -->
<button
  type="button"
  class="btn btn-primary"
  data-mdb-toggle="modal"
  data-mdb-target="#publications-reach">
  <i class="fas fa-chevron-circle-right"></i>
</button>

<!-- Modal -->
<div
  class="modal fade"
  id="publications-reach"
  tabindex="-1"
  aria-labelledby="exampleModalLabel"
  aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Reporte de Alcance de las publicaciones por año</h5>
        <button type="button"class="btn-close"  data-mdb-dismiss="modal"aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <div class="row">
          <div class="col-md-6 text-left">
            <label for="">Año</label>
            <input id="date2" class="form-control" required type="number" min="2000"  name="" value="{{$help::yearToday()}}">
          </div>
        </div>

      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-primary" data-mdb-dismiss="modal">
          <i class="fas fa-window-close fa-2x"></i>
        </button>
        <button type="button" class="btn btn-success" onclick="reporte2('excel')" name="button"><i class="fas fa-file-excel fa-2x"></i></button>

        <button type="button" class="btn btn-danger" onclick="reporte2('pdf')" name="button"><i class="fas fa-file-pdf fa-2x"></i></button>
      </div>
    </div>
  </div>
</div>

<script type="text/javascript">
function reporte2(format){
 var date =  $("#date2").val();

var fecha = new Date();
var year= fecha.getFullYear();

if(date==null ||date == "") date= year;

window.open("{{$help::url()}}publications/reports/strategic/reach/"+format+"/"+date, "_blank");
return false;
 }
</script>
