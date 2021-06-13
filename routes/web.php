<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\User\UserController;
use App\Http\Controllers\Role\RoleController;
use App\Http\Controllers\API\APIController;
use App\Http\Controllers\Suggestions\SuggestionsController;
use App\Http\Controllers\Training\TrainingController;
use App\Http\Controllers\ISO\ISOController;
use App\Http\Controllers\System\SystemController;

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
//print users
Route::middleware(['auth:sanctum', 'verified'])->get('users/print', [UserController::class,'printUsers'])->name('print_users');

//Role
Route::middleware(['auth:sanctum', 'verified'])->get('/roles', [RoleController::class,'roles'])->name('roles');

//language
Route::get('/lang/{language}', function ($language) {
  //  Session::put('language',$language);
   session()->put('locale', $language);
   return redirect()->back();
})->name('language')->middleware('translate');

//suggestions

Route::middleware(['auth:sanctum', 'verified'])->prefix('suggestion')->group(function(){
  Route::get('/home', [SuggestionsController::class,'home'])->name('suggestions-home');
  Route::get('/reports/strategic/types/{typeId}/{format}/{yi}/{yf}', [SuggestionsController::class,'reportSuggestionsByType'])->name('suggestions-strategic-type');
  Route::get('/reports/tactical/date/{typeId}/{format}/{fi}/{ff}', [SuggestionsController::class,'reportSuggestionsByDate'])->name('suggestions-tactical-date');
});


Route::middleware(['auth:sanctum', 'verified'])->prefix('training')->group(function(){
  Route::get('/home', [TrainingController::class,'home'])->name('training-home');
  Route::get('/reports/strategic/r1/{format}/{yi}/{yf}', [TrainingController::class,'r1_'])->name('training-strategic-r1');
  Route::get('/reports/strategic/r2/{format}/{yi}/{yf}', [TrainingController::class,'r2_'])->name('training-strategic-r2');
//  Route::get('/reports/tactical/date/{typeId}/{format}/{fi}/{ff}', [SuggestionsController::class,'reportSuggestionsByDate'])->name('suggestions-tactical-date');
  Route::get('/reports/strategic/r3/{format}/{yi}/{yf}', [TrainingController::class,'r3_'])->name('training-strategic-r3');
  Route::get('/reports/tactical/r4/{format}/{trainingId}',[TrainingController::class,'r4_'])->name('training-tactical-r4');
  Route::get('/reports/tactical/r5/{format}/{trainingId}',[TrainingController::class,'r5_'])->name('training-tactical-r5');
  Route::get('/reports/tactical/r6/{format}/{trainingId}',[TrainingController::class,'r6_'])->name('training-tactical-r6');
});


Route::middleware(['auth:sanctum', 'verified'])->prefix('iso')->group(function(){
  Route::get('/home', [ISOController::class,'home'])->name('iso-home');
    Route::get('/reports/tactical/r1/{format}/{container}', [ISOController::class,'r1_'])->name('iso-tactical-r1');
    Route::get('/reports/tactical/r2/{format}/{type}', [ISOController::class,'r2_'])->name('iso-tactical-r2');
});

//Sección de sistema
Route::middleware(['auth:sanctum', 'verified'])->prefix('system')->group(function(){
  Route::get('/', [SystemController::class,'system'])->name('system');
  Route::get('/print-logs/{format}/{yi}/{yf}', [SystemController::class,'printLogs'])->name('print_logs');
  Route::get('/database/backup', [SystemController::class,'backupDatabase'])->name('backup-database');      
  Route::post('/database/import',[SystemController::class,'importDatabase'])->name('import-database');
});

//API
Route::middleware(['auth:sanctum', 'verified'])->get('api-consumption', [APIController::class,'getAllInformation'])->name('getAllInformation');

