<?php

namespace App\Http\Controllers\Role;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RoleController extends Controller
{
    public function roles(){        
        if(Auth::user()->hasPermissionTo('retrieve_roles')){
            activity('/roles')
            ->by(Auth::user())
            ->log('El usuario '.Auth::user()->name.' visitó /roles.');
            return view('role.roles');
        }
        else{
            activity('/roles')
            ->by(Auth::user())
            ->log('El usuario '.Auth::user()->name.' intentó visitar /roles pero no tiene permisos para hacerlo.');
            abort(403,__('Unauthorized'));
        }        
    }
}
