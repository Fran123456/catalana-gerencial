<div class="card">

  <div class="text-center mt-3">
    <span style="font-size: 48px;" class="text-primary">
      <i class="fa fa-database fa-2x"></i>
    </span>
  </div>
    <div class="card-body text-center">
        <h5 class="card-title">ETL</h5>
        <p class="card-text">
        </p>


        <div wire:loading.remove>
          <button id="btn"  wire:click="data()" class="btn btn-primary"><i class="fas fa-save"></i></button>
        </div>

        <div class="text-center" wire:loading wire:target="data">
          <div class="d-flex justify-content-center">
              <i class="fas fa-sync fa-spin fa-2x"></i>
        </div>
        </div>

        @if (session()->has('message'))
          <div id="message">
            <span  class="badge bg-primary mt-2">
            Actualización de información completa <i class="fas fa-thumbs-up" ></i>
          </span>
          </div>

        @endif

    </div>
</div>


<script type="text/javascript">
Livewire.on('send',() => {
    setTimeout(function(){$("#message").fadeOut('fast');}, 1000);
})
</script>
