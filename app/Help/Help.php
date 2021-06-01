<?php

namespace App\Help;
use Illuminate\Support\Facades\Storage;
use App\ClimaPreguntaEmpleados;
use Illuminate\Support\Facades\URL;

class Help
{

	public static function url(){
      $url =  URL::to('/')."/";
			return $url;
	}

	 public static function yearToday(){
	 	$hoy = getdate();
	 	return $hoy['year'];
	 }


	 public static function dateYear(){
		 $hoy = getdate();
     return $hoy['year'].'-'.$hoy['mon'].'-'.$hoy['mday'];
	 }


}
 ?>
