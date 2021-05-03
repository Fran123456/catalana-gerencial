<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\User\UserController;
use App\Http\Controllers\Role\RoleController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::middleware(['auth:sanctum', 'verified'])->get('/dashboard', function () {
    return view('dashboard');
})->name('dashboard');


//user
Route::middleware(['auth:sanctum', 'verified'])->get('users', [UserController::class,'users'])->name('users');

//Role
Route::middleware(['auth:sanctum', 'verified'])->get('/roles', [RoleController::class,'roles'])->name('roles');

//language
Route::get('/lang/{language}', function ($language) {
    Session::put('language',$language);
   return redirect()->back();
})->name('language')->middleware('translate');
