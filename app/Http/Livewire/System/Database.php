<?php

namespace App\Http\Livewire\System;

use App\Help\Help;
use App\Http\Controllers\System\SystemController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Livewire\Component;
use Illuminate\Http\Request;
use Livewire\WithFileUploads;

class Database extends Component
{
    use WithFileUploads;
    
    public $file;    
    
    public function render()
    {
        $help = new Help();
        return view('livewire.system.database',compact('help'));
    }

    public function submit(){
        if(Auth::user()->hasPermissionTo('backup')){         

                   
            $dataValid = $this->validate([
                'file' => 'required',
            ]);

            $file = $this->file->store('', 'public');                                    
            DB::unprepared( file_get_contents(storage_path('app\public\\').$file));            
            
            session()->flash('message','Base de datos restaurada exitosamente.');
            activity('Restauración base de datos')
            ->by(Auth::user())
            ->log('El usuario '.Auth::user()->name.' restauró la base de datos.');

            abort(403,__('Unauthorized'));
            
            $this->dispatchBrowserEvent('redireccionar');
        }
        else{
            activity('Acceso denegado')
            ->by(Auth::user())
            ->log('El usuario '.Auth::user()->name.' intentó restaurar la base de datos.');        

            abort(403,__('Unauthorized'));
        }
    }    

    public function clean(){
        $this->file = null;
    }
}
