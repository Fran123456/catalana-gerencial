<!-- Button trigger modal -->
<button
  type="button"
  class="btn btn-primary"
  data-mdb-toggle="modal"
  data-mdb-target="#r1">
  <i class="fas fa-chevron-circle-right"></i>
</button>

<!-- Modal -->
<div
  class="modal fade"
  id="r1"
  tabindex="-1"
  aria-labelledby="exampleModalLabel"
  aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Reporte de procesos generados y documento activo</h5>
        <button type="button"class="btn-close"  data-mdb-dismiss="modal"aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <div class="row">
          <div class="col-md-12 text-left">
            <label for="">Proceso</label>
            <select id="option-iso-r1" class="form-control" name="">
              @foreach ($containers as $key => $value)
                <option value="{{$value->id}}">{{$value->title}}</option>
              @endforeach
                <option value="0">TODOS</option>
            </select>
          </div>

        </div>

      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-primary" data-mdb-dismiss="modal">
          <i class="fas fa-window-close fa-2x"></i>
        </button>
        <button id="" type="button" class="btn btn-success" onclick="reporte1('excel')" name="button"><i class="fas fa-file-excel fa-2x"></i></button>

        <button id="" type="button" class="btn btn-danger" onclick="reporte1('pdf')" name="button"><i class="fas fa-file-pdf fa-2x"></i></button>
      </div>
    </div>
  </div>
</div>

<script type="text/javascript">
function reporte1(type){
 var data =  $("#option-iso-r1").val();
  window.open("{{$help::url()}}iso/reports/tactical/r1/" +type+"/"+data, "_blank");
  return false;
 }

/* $("option-iso-r1").on('change', function (){
   var x = $('#option-type-r4').val();
   if(x==0){
     $('#pdfr4').prop('disabled', true);
   }else{
     $('#pdfr4').prop('disabled',false);
   }
});*/

</script>
