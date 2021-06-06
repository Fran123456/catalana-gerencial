<?php

namespace App\Http\Controllers\Training;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Help\Help;

class TrainingController extends Controller
{
  public function __construct(){
    set_time_limit(8000000);
    $this->middleware('auth');
  }


  public function home(){
    $help = new Help();
    return view ('training.home',compact('help'));
  }


 //report training scorebytraining = strategic
 public function r1_($type , $yeari, $yearf){

 }
 //report training number of quiz answered and not answered
 public function r2_($type , $yeari, $yearf){

 }


}
