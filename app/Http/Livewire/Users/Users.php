<?php

namespace App\Http\Livewire\Users;
use Livewire\WithPagination;
use Livewire\Component;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;
use Spatie\Permission\Models\Role;

class Users extends Component
{
   use WithPagination;
   protected $paginationTheme = 'tailwind'; //deshabilitar si se quiere utilizar la generica
   public $name;
   public $email;
   public $password;
   public $idUser;
   public $search;
   public $role;
  // public $users;

    public function clean(){//de sistema
     $this->name= "";
     $this->email= "";
     $this->password= "";
     $this->idUser ="";
     $this->search ="";
     $this->role ="";
    }

    public function render()
    {
      $roles = Role::all();
      if($this->search==null|| $this->search ==""){
        $users = User::orderBy('id','desc')->paginate(5);
      }else{
        $users =User::where('name','like', '%'.$this->search.'%')->orderBy('id','desc')->paginate(5);
      }
       return view('livewire.users.users', compact('users','roles'));
    }

    public function store(){
      $this->validate([
        'name'=>'required',
        'email'=>'required|email',
        'password'=> 'required',
      ]);
       $u =User::create([
        'name' => $this->name,
        'email' => $this->email,
        'password' => Hash::make($this->password)
      ]);
      $u->assignRole($role);
      session()->flash('message', ':data created successfully');
      $this->clean();
      $this->emit("send");
    }

    public function destroy($id){
      User::destroy($id);
      session()->flash('message-destroy', ':data successfully removed');
      $this->emit("destroy");
    }

    public function getUser($id){
       $user = User::find($id);
       $this->asigned($user);
    }

    public function update(){
      $this->validate([
        'name'=>'required',
        'email'=>'required',
      ]);

      $user = User::where('id', $this->idUser)->update([
        'name' => $this->name,
        'email' => $this->email,
      ]);
      session()->flash('message-update', ':data successfully updated');
      $this->emit("update");
    }

    private function asigned($user){
      $this->name = $user->name;
      $this->email = $user->email;
      $this->idUser = $user->id;
     //  $this->password = $user->password;
    }

}
