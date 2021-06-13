<!-- Button trigger modal -->
<button
  type="button"
  class="btn btn-primary"
  data-mdb-toggle="modal"
  data-mdb-target="#publications-seen">
  <i class="fas fa-chevron-circle-right"></i>
</button>

<!-- Modal -->
<div
  class="modal fade"
  id="publications-seen"
  tabindex="-1"
  aria-labelledby="exampleModalLabel"
  aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Empleados que han visto una publicación</h5>
        <button type="button"class="btn-close"  data-mdb-dismiss="modal"aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <div class="row">
            <div class="col-md-12 text-left">
                <label for="">Publicación</label>
                <select required class="form-control" name="" id="option-seen">
                    @foreach ($publications as $id => $titulo)
                      <option value="{{$id}}">{{$titulo}}</option>
                    @endforeach
                </select>
          </div>
        </div>

      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-primary" data-mdb-dismiss="modal">
          <i class="fas fa-window-close fa-2x"></i>
        </button>
        <button type="button" class="btn btn-success" onclick="reporte3('excel')" name="button"><i class="fas fa-file-excel fa-2x"></i></button>

        <button type="button" class="btn btn-danger" onclick="reporte3('pdf')" name="button"><i class="fas fa-file-pdf fa-2x"></i></button>
      </div>
    </div>
  </div>
</div>

<script type="text/javascript">

function reporte3(format){
    var publicationsId =$("#option-seen").val();
    window.open("{{$help::url()}}publications/reports/tactical/seen/"+format+"/"+publicationsId, "_blank");
  return false;
 }
</script>
