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
      if(Auth::user()->hasPermissionTo('retrieve_users')){
        activity('Visita')
        ->by(Auth::user())
        ->log('El usuario '.Auth::user()->name.' visitó /users.');
        return view('user.users');
      }
      else{
        activity('Acceso denegado')
        ->by(Auth::user())
        ->log('El usuario '.Auth::user()->name.' intentó visitar /users.');
        abort(403,__('Unauthorized'));
      }        
      
    }

    public function printUsers(){
      if(Auth::user()->hasPermissionTo('print_users')){
        $users = DB::table('users')
                ->join('model_has_roles','users.id','=','model_has_roles.model_id')
                ->join('roles','roles.id','=','model_has_roles.role_id')
                ->orderBy('users.name','ASC')
                ->select('users.id','users.name','users.email','roles.name as role')->get();
        $pdf = PDF::loadView('pdf-reports.users.users', compact('users'));

        activity('Generación de reporte de usuarios')
        ->by(Auth::user())
        ->log('El usuario '.Auth::user()->name.'imprimió el reporte de usuarios del sistema en PDF.');

        return $pdf->setPaper('A4','landscape')->stream('usuarios.pdf');
      }
      else{
        activity('Acceso denegado')
        ->by(Auth::user())
        ->log('El usuario '.Auth::user()->name.' intentó imprimir el reporte de usuarios del sistema.');
        
        abort(403,__('Unauthorized'));
      }
    }
}