<?php

namespace App\Http\Livewire\Roles;

use Illuminate\Support\Facades\DB;
use Livewire\Component;
use Livewire\WithPagination;
use Spatie\Permission\Models\Role;

class Roles extends Component
{
    use WithPagination;
    public $search_role;
    public $pagination_size = 2;

    public $role_name;
    public $role_id;

    protected $queryString=['search_role' => ['except'=>'']];

    public function render()
    {
        $search=$this->search_role;
        
        if($this->search_role==null || $this->search_role ==""){
            $roles=DB::table('roles')
                ->select('roles.id','roles.name',DB::raw('count(model_has_roles.role_id) as conteo'))
                ->leftJoin('model_has_roles','roles.id','=','model_has_roles.role_id')
                ->groupBy('roles.id')
                ->orderBy('roles.name','ASC')
                ->paginate(2);
        }
        else{
            //$roles = Role::where('name','like', '%'.$this->search_role.'%')->orderBy('name','ASC')->paginate(2);
            $roles=DB::table('roles')
                ->select('roles.id','roles.name',DB::raw('count(model_has_roles.role_id) as conteo'))
                ->leftJoin('model_has_roles','roles.id','=','model_has_roles.role_id')                    
                ->where('name','like', '%'.$this->search_role.'%')
                ->groupBy('roles.id')
                ->orderBy('roles.name','ASC')
                ->paginate($this->pagination_size);
        }    

        return view('livewire.roles.roles', compact('roles','search'));
    }

    public function getRole($id){
        $role = Role::find($id);
        $this->asigned($role);
     }

     private function asigned($role){
        $this->role_name = $role->name;
        $this->role_id = $role->id;
      }

      public function update(){
        $this->validate([
          'role_name'=>'required',          
        ]);
  
        $role = Role::where('id', $this->role_id)->update([
          'name' => $this->role_name,          
        ]);        
  
        session()->flash('message-update', ':data successfully updated');
        $this->emit("update");
      }

      public function store(){
        $this->validate([
            'role_name'=>'required',            
          ]);
           $role =Role::create([
            'name' => $this->role_name,
            'guard_name' => 'web'
          ]);          
          session()->flash('message', ':data created successfully');
          $this->clean();
          $this->emit("send");
      }      

      public function destroy($id){
        Role::destroy($id);
        session()->flash('message-destroy', ':data successfully removed');
        $this->emit("destroy");
      }

      public function clean(){
        $this->role_name='';
        $this->role_id='';
      }      
}
