<?php

namespace App\Http\Livewire\Users;
use Livewire\WithPagination;
use Livewire\Component;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class Users extends Component
{
   use WithPagination;
   public $name;
   public $email;
   public $password;

    public function mount(){//de sistema
     $this->name= "";
     $this->email= "";
     $this->password= "";
    }

    public function render()
    {
       $users = User::paginate(10);
       return view('livewire.users.users', compact('users'));
    }

    public function store(){

      $this->validate([
        'name'=>'required',
        'email'=>'required',
        'password'=> 'required',
      ]);

      /*$user = User::create([
        'name' => $this->name,
        'email' => $this->email,
        'password' => Hash::make($this->password)
      ]);*/

      session()->flash('message', ':data created successfully');
      $this->mount();
      $this->emit("send");
      //$this->dispatchBrowserEvent('closeModal');
      //$this->emit("recived", $m);
      //event(new \App\Events\User($user));
    }
}
