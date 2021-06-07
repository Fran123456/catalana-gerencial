<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Livewire\Users\Users;
use App\Models\User;
use Barryvdh\DomPDF\Facade as PDF;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class UserController extends Controller
{
    public function users(){
      return view('user.users');
    }

    public function printUsers(){
      if(Auth::user()->hasPermissionTo('print_users')){
        $users = DB::table('users')
                ->join('model_has_roles','users.id','=','model_has_roles.model_id')
                ->join('roles','roles.id','=','model_has_roles.role_id')
                ->orderBy('users.name','ASC')
                ->select('users.id','users.name','users.email','roles.name as role')->get();
        $pdf = PDF::loadView('pdf-reports.users.users', compact('users'));
        return $pdf->setPaper('A4','landscape')->stream('usuarios.pdf');
      }
      else{
        abort(403,__('Unauthorized'));
      }
    }
}