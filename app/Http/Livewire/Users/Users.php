<?php

namespace App\Http\Livewire\Users;

use Livewire\Component;
use App\Models\User;

class Users extends Component
{
    public function render()
    {
       $users = User::all();
       return view('livewire.users.users', compact('users'));
    }
}
