<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Livewire\Users\Users;

class UserController extends Controller
{
    public function users(){
      return view('user.users');
    }
}
