<!-- Button trigger modal -->
<button
  type="button"
  class="btn btn-primary"
  data-mdb-toggle="modal"
  data-mdb-target="#sugerencias-tipo">
  <i class="fas fa-chevron-circle-right"></i>
</button>

<!-- Modal -->
<div
  class="modal fade"
  id="sugerencias-tipo"
  tabindex="-1"
  aria-labelledby="exampleModalLabel"
  aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Cantidad de sugerencias realizadas por tipo</h5>
        <button type="button"class="btn-close"  data-mdb-dismiss="modal"aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <div class="row">
          <div class="col-md-12 text-left">
            <label>Tipo de sugerencia</label>
            <select required class="form-control" name="" id="option-type">
              @foreach ($types as $key => $value)
                <option value="{{$value->id}}">{{$value->suggestion_type}}</option>
              @endforeach
            </select>
          </div>
          <div class="col-md-6 text-left">
            <br>
            <label for="">Año inicial</label>
            <input id="yeari-type" class="form-control" required type="number" min="2000" name="" value="{{$help::yearToday()}}">
          </div>

          <div class="col-md-6 text-left">
            <br>
            <label for="">Año final</label>
            <input id="yearf-type" class="form-control" required type="number" min="2000" name="" value="{{$help::yearToday()}}">
          </div>
        </div>

      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-primary" data-mdb-dismiss="modal">
          <i class="fas fa-window-close fa-2x"></i>
        </button>

        <button type="button" class="btn btn-success" onclick="reporte('excel')" name="button"><i class="fas fa-file-excel fa-2x"></i></button>
        <button type="button" class="btn btn-danger" onclick="reporte('pdf')" name="button"><i class="fas fa-file-pdf fa-2x"></i></button>
      </div>
    </div>
  </div>
</div>

<script type="text/javascript">
function reporte(type){
 var yeari =  $("#yeari-type").val();
 var yearf  = $("#yearf-type").val();
 var typeId = $("#option-type").val();

 if(yeari==null ||yeari == "")yeari = "no";
 if(yearf==null ||yearf == "")yearf= "no";
    window.open("{{$help::url()}}suggestion/reports/strategic/types/" + typeId + "/"+type+"/"+yeari+"/"+yearf, "_blank");
   return false;
 }
</script>
