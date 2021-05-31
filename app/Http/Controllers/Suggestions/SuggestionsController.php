<?php

namespace App\Http\Controllers\Suggestions;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\SuggestionType;

class SuggestionsController extends Controller
{
    public function __construct(){
      set_time_limit(8000000);
      $this->middleware('auth');
    }

    public function home(){
       $types = SuggestionType::all();
      return view ('suggestions.home',compact('types'));
    }
}
