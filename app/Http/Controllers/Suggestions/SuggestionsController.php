<?php

namespace App\Http\Controllers\Suggestions;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class SuggestionsController extends Controller
{
    public function __construct(){
      set_time_limit(8000000);
      $this->middleware('auth');
    }

    public function home(){
      return view ('suggestions.home');
    }
}
