<?php

namespace App\Http\Controllers\Suggestions;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\SuggestionType;
use App\Help\Help;
use Illuminate\Support\Facades\URL;

class SuggestionsController extends Controller
{
    public function __construct(){
      set_time_limit(8000000);
      $this->middleware('auth');
    }

    public function home(){
       $types = SuggestionType::all();
       $help = new Help();
      return view ('suggestions.home',compact('types','help'));
    }

    //report strategicos
    public function reportSuggestionsByType($typeId, $format, $yi, $yf){

    }

    //tacticos
    public function reportSuggestionsByDate($typeId, $format, $fi, $ff){

    }
    //tacticos

}
