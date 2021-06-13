<x-app-layout>

<div class="row">
    {{--<div class="col-md-4">
        <livewire:data.data/>
    </div>--}}

    <div class="col-md-4">
      <div class="card ">
        <div class="text-center mt-3">
          <span style="font-size: 48px;" class="text-primary">          
          <i class="fas fa-clipboard-list fa-2x"></i>
         </span>
        </div>
          <div class="card-body text-center">
             <h5 class="card-title">BITÁCORA</h5>
             <p class="card-text">
             </p>
             <div>
                @include('system.modals.filter-date-modal')
             </div>
          </div>
      </div>
    </div>

    <div class="col-md-4">
      <div class="card ">
        <div class="text-center mt-3">
          <span style="font-size: 48px;" class="text-primary">          
          <i class="fa fa-database fa-2x"></i>
         </span>
        </div>
          <div class="card-body text-center">
             <h5 class="card-title">Backup</h5>
             <p class="card-text">
             </p>
             <div>
                <button type="button" class="btn btn-success" onclick="backup()" name="button"><i class="fas fa-download fa-2x"></i></button>
             </div>
          </div>
      </div>
    </div>

    <div class="col-md-4">
      <div class="card ">
        <div class="text-center mt-3">
          <span style="font-size: 48px;" class="text-primary">          
          <i class="fa fa-database fa-2x"></i>
         </span>
        </div>
          <div class="card-body text-center">
             <h5 class="card-title">Restaurar base de datos</h5>
             <p class="card-text">
             </p>
             <div>
             <form method="POST" action="{{route('import-database')}}" accept-charset="UTF-8" enctype="multipart/form-data">
              @csrf             
                <input type="file" accept=".sql" class="form-control" name="file">
                <button type="submit" class="btn btn-success">Submit</button>
             </form>
             </div>
          </div>
      </div>
    </div>

</div>


<script type="text/javascript">
function backup(){
 
  window.open("{{$help::url()}}system/database/backup", "_blank");
  return false;
}
</script>
    
</x-app-layout>
