<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Area;
use App\Models\Department;
use App\Models\Employee;
use App\Models\Enterprise;
use App\Models\Position;
use App\Models\Publication;
use App\Models\PublicationEmployee;
use App\Models\Suggestion;
use App\Models\SuggestionType;
use App\Models\Training;
use App\Models\TrainingEmployee;
use App\Models\TrainingType;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Date;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;

class APIController extends Controller
{
    public $token="uDmLdfuTK9bucf9SghFq";

    public function getAllInformation(){        

        $this->getAllEnterprises();
        $this->getAllAreas();
        $this->getAllDepartments();
        $this->getAllPositions();
        $this->getAllEmployees();
        $this->getAllSuggestionType();
        $this->getAllSuggestion();
        $this->getAllPublication();
        $this->getAllPublicationEmployee();        
        $this->getAllTrainingType();
        $this->getAllTraining();
        $this->getAllTrainingEmployee();
    }

    public function getAllEnterprises(){
        $url = "http://ccpcatalana.com/api/public/api/gerenciales/empresas/".$this->token;

        $response = Http::get($url)->json();        

        foreach ($response as $enterprise){
            Enterprise::firstOrCreate([
                'enterprise' => $enterprise['empresa'],
                'id' => $enterprise['id'],
            ]);
        }
        $query = DB::select("SELECT id,enterprise as empresa FROM enterprises");
        foreach ($query as $i => $after) {
            $flag = 0;
            foreach ($response as $j => $before) {
                if($after->id == $before['id']){
                    $flag = 1;
                    break 1;
                }
            }
            if($flag == 0){
                Enterprise::destroy($after->id);
            }
        }
    }

    public function getAllAreas(){
        $url = "http://ccpcatalana.com/api/public/api/gerenciales/areas/".$this->token;

        $response = Http::get($url)->json();

        foreach ($response as $area) {
            Area::firstOrCreate([
                'enterprise_id' => $area['empresa_id'],
                'area' => $area['area'],
                'id' => $area['id'],
            ]);
        }
        $query = DB::select("SELECT id FROM areas");
        foreach ($query as $i => $after) {
            $flag = 0;
            foreach ($response as $j => $before) {
                if($after->id == $before['id']){
                    $flag = 1;
                    break 1;
                }
            }
            if($flag == 0){
                Area::destroy($after->id);
            }
        }
    }

    public function getAllDepartments(){
        $url = "http://ccpcatalana.com/api/public/api/gerenciales/departamentos/".$this->token;

        $response = Http::get($url)->json();

        foreach ($response as $department) {
            Department::firstOrCreate([
                'area_id' => $department['area_id'],
                'department' => $department['departamento'],
                'id' => $department['id'],
            ]);
        }
        $query = DB::select("SELECT id FROM departments");
        foreach ($query as $i => $after) {
            $flag = 0;
            foreach ($response as $j => $before) {
                if($after->id == $before['id']){
                    $flag = 1;
                    break 1;
                }
            }
            if($flag == 0){
                Department::destroy($after->id);
            }
        }
    }

    public function getAllPositions(){
        $url = "http://ccpcatalana.com/api/public/api/gerenciales/cargos/".$this->token;

        $response = Http::get($url)->json();

        foreach ($response as $position) {
            Position::firstOrCreate([
                'position' => $position['cargo'],
                'id' => $position['id'],
            ]);
        }
        $query = DB::select("SELECT id FROM positions");
        foreach ($query as $i => $after) {
            $flag = 0;
            foreach ($response as $j => $before) {
                if($after->id == $before['id']){
                    $flag = 1;
                    break 1;
                }
            }
            if($flag == 0){
                Position::destroy($after->id);
            }
        }
    }

    public function getAllEmployees(){
        $url = "http://ccpcatalana.com/api/public/api/gerenciales/empleados/".$this->token;

        $response = Http::get($url)->json();

        foreach ($response as $employee) {
            Employee::firstOrCreate([                
                'id' => $employee['id'],
                'names' => $employee['nombres'],
                'lastnames' => $employee['apellidos'],
                'dui' => $employee['dui'],
                'nit' => $employee['nit'],
                'isss' => $employee['isss'],
                'department_id' => $employee['departamento_id'],
                'enterprise_id' => $employee['empresa_id'],
                'area_id' => $employee['area_id'],
                'position_id' => $employee['cargo_id'],
                'enabled' => $employee['habilitado'],
                'coordinator' => $employee['coordinador'],
                'boss_list' => $employee['lista_jefe'],
            ]);
        }
        $query = DB::select("SELECT id FROM employees");
        foreach ($query as $i => $after) {
            $flag = 0;
            foreach ($response as $j => $before) {
                if($after->id == $before['id']){
                    $flag = 1;
                    break 1;
                }
            }
            if($flag == 0){
                Employee::destroy($after->id);
            }
        }
    }


    public function getAllSuggestionType(){
        $url = "http://ccpcatalana.com/api/public/api/gerenciales/tipos/sugerencias/".$this->token;

        $response = Http::get($url)->json();

        foreach ($response as $suggestion_type) {
            SuggestionType::firstOrCreate([
                'status' => $suggestion_type['estado'],
                'suggestion_type' => $suggestion_type['tipo'],
                'id' => $suggestion_type['id'],
            ]);
        }
        $query = DB::select("SELECT id FROM suggestion_types");
        foreach ($query as $i => $after) {
            $flag = 0;
            foreach ($response as $j => $before) {
                if($after->id == $before['id']){
                    $flag = 1;
                    break 1;
                }
            }
            if($flag == 0){
                SuggestionType::destroy($after->id);
            }
        }
    }

    public function getAllSuggestion(){
        $url = "http://ccpcatalana.com/api/public/api/gerenciales/sugerencias/".$this->token;

        $response = Http::get($url)->json();

        foreach ($response as $suggestion) {
            Suggestion::firstOrCreate([
                'id' => $suggestion['id'],                
                'suggestion' => $suggestion['sugerencia'],
                'suggestion_type_id'=>intval($suggestion['tipo_id']),
                'suggestion_type'=>$suggestion['tipo'],
                'date'=>Carbon::createFromTimeString(($suggestion['fecha'])),
                'reading'=>$suggestion['lectura'],
                'employee_id'=>$suggestion['empleado_id'],                
            ]);
        }
        $query = DB::select("SELECT id FROM suggestions");
        foreach ($query as $i => $after) {
            $flag = 0;
            foreach ($response as $j => $before) {
                if($after->id == $before['id']){
                    $flag = 1;
                    break 1;
                }
            }
            if($flag == 0){
                Suggestion::destroy($after->id);
            }
        }
    }

    public function getAllPublication(){
        $url = "http://ccpcatalana.com/api/public/api/gerenciales/publicaciones/".$this->token;

        $response = Http::get($url)->json();

        foreach ($response as $publication) {
            Publication::firstOrCreate([
                'id' => $publication['id'],      
                'title' => $publication['titulo'],
                'type'=>$publication['tipo'],
                'date'=>Carbon::createFromTimeString(($publication['fecha'])),
                'year'=>intval($publication['year']),
            ]);
        }
        $query = DB::select("SELECT id FROM publications");
        foreach ($query as $i => $after) {
            $flag = 0;
            foreach ($response as $j => $before) {
                if($after->id == $before['id']){
                    $flag = 1;
                    break 1;
                }
            }
            if($flag == 0){
                Publication::destroy($after->id);
            }
        }
    }
    
    public function getAllPublicationEmployee(){
        $url = "http://ccpcatalana.com/api/public/api/gerenciales/empleadosPublicaciones/".$this->token;
        $response = Http::get($url)->json();
            
        foreach ($response as $publication) {
            if($publication['vista']=='si'){
                PublicationEmployee::firstOrCreate([
                    'id' => $publication['id'],
                    'publication_id' => $publication['publicacion_id'],
                    'employee_id'=>$publication['empleado_id'],
                    'seen' => 1
                ]);        
            }
            else{
                PublicationEmployee::firstOrCreate([
                    'id' => $publication['id'],
                    'publication_id' => $publication['publicacion_id'],
                    'employee_id'=>$publication['empleado_id'],
                    'seen' => 0
                ]);
            }            
        }
        $query = DB::select("SELECT id FROM publication_employees");
        foreach ($query as $i => $after) {
            $flag = 0;
            foreach ($response as $j => $before) {
                if($after->id == $before['id']){
                    $flag = 1;
                    break 1;
                }
            }
            if($flag == 0){
                PublicationEmployee::destroy($after->id);
            }
        }
    }

    public function getAllTrainingType(){
        $url = "http://ccpcatalana.com/api/public/api/gerenciales/tipos/capacitaciones/".$this->token;

        $response = Http::get($url)->json();

        foreach ($response as $i => $type) {
            TrainingType::firstOrCreate([                
                'text'=>array_pop($type),
                'training_type' => array_pop($type),
                'id' => $i+1
            ]);
        }
        $query = DB::select("SELECT training_type FROM training_types");
        foreach ($query as $i => $after) {
            $flag = 0;
            foreach ($response as $j => $before) {
                array_pop($before);
                if($after->training_type == array_pop($before)){
                    $flag = 1;
                    break 1;
                }
            }
            if($flag == 0){
                DB::select('DELETE FROM training_types WHERE type = ?',[$after->training_type]);
            }
        }        
    }

    public function getAllTraining(){
        $url = "http://ccpcatalana.com/api/public/api/gerenciales/capacitaciones/".$this->token;

        $response = Http::get($url)->json();

        foreach ($response as $training){
            Training::firstOrCreate([
                'id' => $training['id'],      
                'training' => $training['capacitacion'],
                'training_type'=>$training['tipo'],
                'start_date'=>$training['fecha_inicio'],
                'end_date'=>$training['fecha_fin'],
                'hour'=> $training['hora'],
                'year'=>intval($training['year']),
            ]);                        
        }
        $query = DB::select("SELECT id FROM trainings");
        foreach ($query as $i => $after) {
            $flag = 0;
            foreach ($response as $j => $before) {
                if($after->id == $before['id']){
                    $flag = 1;
                    break 1;
                }
            }
            if($flag == 0){
                Training::destroy($after->id);
            }
        }        
    }

    public function getAllTrainingEmployee(){
        $url = "http://ccpcatalana.com/api/public/api/gerenciales/capacitaciones/empleados/".$this->token;

        $response = Http::get($url)->json();

        foreach ($response as $training) {
            TrainingEmployee::firstOrCreate([
                'id' => $training['id'],      
                'employee_id' => $training['empleado_id'],
                'training_id' => $training['capacitacion_id'],
                //'date'=>Carbon::createFromTimeString(($training['fecha'])),
                'score' => $training['nota'],
                'taken' => $training['resuelto'],
                'seen' => $training['lectura']
            ]);
        }
        $query = DB::select("SELECT id FROM training_employees");
        foreach ($query as $i => $after) {
            $flag = 0;
            foreach ($response as $j => $before) {
                if($after->id == $before['id']){
                    $flag = 1;
                    break 1;
                }
            }
            if($flag == 0){
                TrainingEmployee::destroy($after->id);
            }
        }        
    }
}