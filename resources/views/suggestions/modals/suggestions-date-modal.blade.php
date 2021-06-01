<!-- Button trigger modal -->
<button
  type="button"
  class="btn btn-primary"
  data-mdb-toggle="modal"
  data-mdb-target="#sugerencias-date">
  <i class="fas fa-chevron-circle-right"></i>
</button>

<!-- Modal -->
<div
  class="modal fade"
  id="sugerencias-date"
  tabindex="-1"
  aria-labelledby="exampleModalLabel"
  aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Sugerencias realizadas por tipo</h5>
        <button type="button"class="btn-close"  data-mdb-dismiss="modal"aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <div class="row">
          <div class="col-md-12 text-left">
            <label>Tipo de sugerencia</label>
            <select required class="form-control" name="" id="option-type-date">
              @foreach ($types as $key => $value)
                <option value="{{$value->id}}">{{$value->suggestion_type}}</option>
              @endforeach
              <option value="0">TODAS</option>
            </select>
          </div>
          <div class="col-md-6 text-left">
            <br>
            <label for="">Fecha inicial</label>
            <input id="datei-date" class="form-control" required type="date"  name="" value="{{$help::dateYear()}}">
          </div>

          <div class="col-md-6 text-left">
            <br>
            <label for="">Fecha final</label>
            <input id="datef-date" class="form-control" required type="date"  name="" value="{{$help::dateYear()}}">
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
 var datei =  $("#datei-date").val();
 var datef  = $("#datef-date").val();
 var typeId =$("#option-type-date").val();

 if(datei==null ||datei == "")datei = "no";
 if(datef==null ||datef == "")datef= "no";
    window.open("{{$help::url()}}suggestion/reports/tactical/date/" + typeId + "/"+type+"/"+datei+"/"+datef, "_blank");
   return false;
 }
</script>
