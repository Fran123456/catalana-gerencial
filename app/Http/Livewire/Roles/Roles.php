<?php

namespace App\Http\Livewire\Roles;

use Livewire\Component;
use Livewire\WithPagination;
use Spatie\Permission\Models\Role;

class Roles extends Component
{
    use WithPagination;
    public $search_role;

    protected $queryString=['search_role' => ['except'=>'']];

    public function render()
    {
        $search=$this->search_role;
        if($this->search_role==null || $this->search_role ==""){
            $roles = Role::orderBy('name','ASC')->paginate(2);
        }
        else{
            $roles = Role::where('name','like', '%'.$this->search_role.'%')->orderBy('name','ASC')->paginate(2);
        }

        return view('livewire.roles.roles', compact('roles','search'));
    }
}
