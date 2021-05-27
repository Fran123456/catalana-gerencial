<?php

namespace App\Http\Livewire\Data;
use App\Http\Controllers\API\APIController;
use Illuminate\Support\Facades\Auth;
use Spatie\Permission\Models\Role;

use Livewire\Component;

class Data extends Component
{
    private $controller;


    public function mount(){


    }

    public function render()
    {
        return view('livewire.data.data');
    }

    public function data(){
      $this->controller = new APIController();
      $this->controller->getAllInformation();
      session()->flash('message', ':data created successfully');
      $this->emit("send");
    }



}
