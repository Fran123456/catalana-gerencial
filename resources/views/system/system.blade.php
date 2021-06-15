<x-app-layout>


  <div class="row">
            
    @can('backup')
    <div class="col-md-4">
        <livewire:data.data/>
    </div>

    <div class="col-md-4">
      <div class="card">
        <div class="text-center mt-3">
          <span style="font-size: 48px;" class="text-primary">          
          <i class="fa fa-database fa-2x"></i>
          </span>
        </div>
        <div class="card-body text-center">
            <h5 class="card-title">Backup base de datos</h5>
            <div>
              @if(session()->has('backup'))
                  <div class="alert alert-success">
                      <strong>{{ session('backup') }}</strong>
                  </div>
              @endif
          </div>                    
            <div>            
            <button type="button" class="btn btn-primary" onclick="backup()" name="button"><i class="fas fa-download"></i></button>
            </div>
        </div>
      </div>
    </div>

    <livewire:system.database/>

    @endcan      
  </div>    
  <br>
  <div class="row">
    @can('logs')    
      <div class="col-md-4">      
        <div class="card">
          <div class="text-center mt-3">
            <span style="font-size: 48px;" class="text-primary">          
              <i class="fas fa-clipboard-list fa-2x"></i>
            </span>
          </div>
          <div class="card-body text-center">
              <h5 class="card-title">BITÁCORA</h5>              
              <div>
                @include('system.modals.filter-date-modal')
              </div>
          </div>
        </div>
      </div>
    @endcan      
  </div>

    @if (auth()->user()->can('logs') == false && auth()->user()->can('backup') == false)
      <div class="row">
        <div class="text-center">
          <h4>SIN PERMISOS</h4>
        </div>
      </div>
    @endif



<script type="text/javascript">
function backup(){
 
  window.open("{{$help::url()}}system/database/backup", "_blank");
  return false;
}
</script>
<script>
window.addEventListener('redireccionar', event => {    
    setTimeout(function(){
      window.location.replace("{{$help::url()}}system");
    },4000);
})
</script>    
</x-app-layout>
