<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Area;
use App\Models\Department;
use App\Models\Enterprise;
use App\Models\Position;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Date;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;

class APIController extends Controller
{
    public $token="uDmLdfuTK9bucf9SghFq";
    
    public function getAllInformation(){                
        
        DB::delete("DELETE FROM positions");
        DB::delete("DELETE FROM departments");
        DB::delete("DELETE FROM areas");
        DB::delete("DELETE FROM enterprises");

        $this->getAllEnterprises();
        $this->getAllAreas();
        $this->getAllDepartments();
        $this->getAllPositions();

        $one = Enterprise::all();
        $two = Area::all();
        $three = Department::all();
        $four = Position::all();

        dd($one,$two,$three,$four);        
    }

    public function getAllEnterprises(){
        $url = "http://ccpcatalana.com/api/public/api/gerenciales/empresas/".$this->token;        
                
        $response = Http::get($url)->json();
                
        foreach ($response as $enterprise) {
            Enterprise::create([
                'enterprise' => $enterprise['empresa'],
                'id' => $enterprise['id'],
                'created_at' => Date::now(),
                'updated_at' => Date::now()
            ]);
        }        
    }

    public function getAllAreas(){
        $url = "http://ccpcatalana.com/api/public/api/gerenciales/areas/".$this->token;

        $response = Http::get($url)->json();

        foreach ($response as $area) {            
            Area::create([
                'enterprise_id' => $area['empresa_id'],
                'area' => $area['area'],
                'id' => $area['id'],
                'created_at' => Date::now(),
                'updated_at' => Date::now()
            ]);            
        }
    }

    public function getAllDepartments(){
        $url = "http://ccpcatalana.com/api/public/api/gerenciales/departamentos/".$this->token;

        $response = Http::get($url)->json();

        foreach ($response as $department) {
            Department::create([
                'area_id' => $department['area_id'],
                'department' => $department['departamento'],
                'id' => $department['id'],
                'created_at' => Date::now(),
                'updated_at' => Date::now()
            ]);            
        }
    }

    public function getAllPositions(){
        $url = "http://ccpcatalana.com/api/public/api/gerenciales/cargos/".$this->token;

        $response = Http::get($url)->json();

        foreach ($response as $position) {
            Position::create([                
                'position' => $position['cargo'],
                'id' => $position['id'],
                'created_at' => Date::now(),
                'updated_at' => Date::now()
            ]);            
        }
    }

    //sustituido por Http:get($url)->json()
    public function requestMethod($url){
        $cliente = curl_init();
        curl_setopt($cliente, CURLOPT_URL, $url);
        curl_setopt($cliente, CURLOPT_HTTPGET, TRUE);
        curl_setopt($cliente, CURLOPT_RETURNTRANSFER, true);
        $remote_server_output = curl_exec($cliente);
        curl_close($cliente);        
        return json_decode($remote_server_output, true);;
    }
}
