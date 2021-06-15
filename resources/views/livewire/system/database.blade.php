<div class="col-md-4">
    <div class="card">
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
                <form wire:submit.prevent="submit" enctype="multipart/form-data">                                    
                    <div>
                        @if(session()->has('message'))
                            <div class="alert alert-success">
                                <strong>{{ session('message') }}</strong>
                            </div>
                        @endif
                    </div>                    
                    <input wire:click="clean" accept=".sql" type="file" class="form-control-file" id="exampleInputName" wire:model="file">
                    @error('file') <span class="text-danger">{{ $message }}</span> @enderror

                    
                    <div wire:loading wire:target="file">
                        <br>
                        <button class="btn btn-primary" type="button" disabled>
                        <span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>
                        Cargando
                        </button>
                    </div>
                    @if ($file != null)
                        <br>
                        <button wire:loading.remove type="submit" class="btn btn-primary"><i class="fas fa-upload"></i></button>                        
                        <div wire:loading wire:target="submit">
                            <button class="btn btn-primary" type="button" disabled>
                            <span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>
                            Restaurando
                            </button>
                        </div>                        
                    @endif                    
                </form>
            </div>            
        </div>
    </div>
</div>