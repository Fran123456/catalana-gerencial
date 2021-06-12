<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Archive;
use App\Models\ArchiveType;
use App\Models\Area;
use App\Models\Container;
use App\Models\Department;
use App\Models\Employee;
use App\Models\Enterprise;
use App\Models\History;
use App\Models\Position;
use App\Models\Publication;
use App\Models\PublicationEmployee;
use App\Models\Subcontainer;
use App\Models\Suggestion;
use App\Models\SuggestionType;
use App\Models\Training;
use App\Models\TrainingEmployee;
use App\Models\TrainingType;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
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
        $this->getAllContainer();
        $this->getAllSubcontainer();
        $this->getAllArchiveType();
        $this->getAllArchive();
        $this->getAllHistory();
        activity('ETL')
            ->by(Auth::user())                        
            ->log('El usuario '.Auth::user()->name.' realizó el proceso de ETL.' );
    }

    public function getAllEnterprises(){
        $url = "http://ccpcatalana.com/api/public/api/gerenciales/empresas/".$this->token;

        $response = Http::get($url)->json();        

        if($this->firstTime('enterprises')){
            foreach ($response as $enterprise){
                Enterprise::create([
                    'enterprise' => $enterprise['empresa'],
                    'id' => $enterprise['id'],
                ]);
            }
        }
        else{
            foreach ($response as $enterprise){
                Enterprise::firstOrCreate([
                    'enterprise' => $enterprise['empresa'],
                    'id' => $enterprise['id'],
                ]);
            }

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
    }

    public function getAllAreas(){
        $url = "http://ccpcatalana.com/api/public/api/gerenciales/areas/".$this->token;

        $response = Http::get($url)->json();

        if($this->firstTime('areas')){
            foreach ($response as $area) {
                Area::create([
                    'enterprise_id' => $area['empresa_id'],
                    'area' => $area['area'],
                    'id' => $area['id'],
                ]);
            }
        }
        else{
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
    }

    public function getAllDepartments(){
        $url = "http://ccpcatalana.com/api/public/api/gerenciales/departamentos/".$this->token;

        $response = Http::get($url)->json();

        if($this->firstTime('departments')){
            foreach ($response as $department) {
                Department::create([
                    'area_id' => $department['area_id'],
                    'department' => $department['departamento'],
                    'id' => $department['id'],
                ]);
            }
        }
        else{
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
    }

    public function getAllPositions(){
        $url = "http://ccpcatalana.com/api/public/api/gerenciales/cargos/".$this->token;

        $response = Http::get($url)->json();

        if($this->firstTime('positions')){
            foreach ($response as $position) {
                Position::create([
                    'position' => $position['cargo'],
                    'id' => $position['id'],
                ]);
            }
        }
        else{
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
    }

    public function getAllEmployees(){
        $url = "http://ccpcatalana.com/api/public/api/gerenciales/empleados/".$this->token;

        $response = Http::get($url)->json();

        if($this->firstTime('employees')){
            foreach ($response as $employee) {
                Employee::create([                
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
        }
        else{
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
    }

    public function getAllSuggestionType(){
        $url = "http://ccpcatalana.com/api/public/api/gerenciales/tipos/sugerencias/".$this->token;

        $response = Http::get($url)->json();

        if($this->firstTime("suggestion_types")){
            foreach ($response as $suggestion_type) {
                SuggestionType::create([
                    'status' => $suggestion_type['estado'],
                    'suggestion_type' => $suggestion_type['tipo'],
                    'id' => $suggestion_type['id'],
                ]);
            }
        }
        else{
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
    }

    public function getAllSuggestion(){
        $url = "http://ccpcatalana.com/api/public/api/gerenciales/sugerencias/".$this->token;

        $response = Http::get($url)->json();

        if($this->firstTime('suggestions')){
            foreach ($response as $suggestion) {
                Suggestion::create([
                    'id' => $suggestion['id'],                
                    'suggestion' => $suggestion['sugerencia'],
                    'suggestion_type_id'=>intval($suggestion['tipo_id']),
                    'suggestion_type'=>$suggestion['tipo'],
                    'date'=>Carbon::createFromTimeString(($suggestion['fecha'])),
                    'reading'=>$suggestion['lectura'],
                    'employee_id'=>$suggestion['empleado_id'],                
                ]);
            }
        }
        else{
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
    }

    public function getAllPublication(){
        $url = "http://ccpcatalana.com/api/public/api/gerenciales/publicaciones/".$this->token;

        $response = Http::get($url)->json();

        if($this->firstTime('publications')){
            foreach ($response as $publication) {
                Publication::create([
                    'id' => $publication['id'],      
                    'title' => $publication['titulo'],
                    'type'=>$publication['tipo'],
                    'date'=>Carbon::createFromTimeString(($publication['fecha'])),
                    'year'=>intval($publication['year']),
                ]);
            }
        }    
        else{
            foreach ($response as $publication) {
                Publication::firstOrCreate([
                    'id' => $publication['id'],      
                    'title' => $publication['titulo'],
                    'type'=>$publication['tipo'],
                    'date'=>Carbon::createFromTimeString(($publication['fecha'])),
                    'year'=>intval($publication['year']),
                ]);

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
        }            
    }
    
    public function getAllPublicationEmployee(){
        $url = "http://ccpcatalana.com/api/public/api/gerenciales/empleadosPublicaciones/".$this->token;
        $response = Http::get($url)->json();
        
        if($this->firstTime('publication_employees')){
            foreach ($response as $publication) {
                if($publication['vista']=='si'){
                    PublicationEmployee::create([
                        'id' => $publication['id'],
                        'publication_id' => $publication['publicacion_id'],
                        'employee_id'=>$publication['empleado_id'],
                        'seen' => 1
                    ]);        
                }
                else{
                    PublicationEmployee::create([
                        'id' => $publication['id'],
                        'publication_id' => $publication['publicacion_id'],
                        'employee_id'=>$publication['empleado_id'],
                        'seen' => 0
                    ]);
                }            
            }
        }
        else{
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
    }

    public function getAllTrainingType(){
        $url = "http://ccpcatalana.com/api/public/api/gerenciales/tipos/capacitaciones/".$this->token;

        $response = Http::get($url)->json();

        if($this->firstTime('training_types')){
            foreach ($response as $i => $type) {
                TrainingType::create([                
                    'text'=>array_pop($type),
                    'training_type' => array_pop($type),
                    'id' => $i+1
                ]);
            }
        }
        else{
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
    }

    public function getAllTraining(){
        $url = "http://ccpcatalana.com/api/public/api/gerenciales/capacitaciones/".$this->token;

        $response = Http::get($url)->json();

        if($this->firstTime('trainings')){
            foreach ($response as $training){
                Training::create([
                    'id' => $training['id'],      
                    'training' => $training['capacitacion'],
                    'training_type'=>$training['tipo'],
                    'start_date'=>$training['fecha_inicio'],
                    'end_date'=>$training['fecha_fin'],
                    'hour'=> $training['hora'],
                    'year'=>intval($training['year']),
                ]);                        
            }
        }    
        else{
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
    }

    public function getAllTrainingEmployee(){
        $url = "http://ccpcatalana.com/api/public/api/gerenciales/capacitaciones/empleados/".$this->token;

        $response = Http::get($url)->json();

        if($this->firstTime('training_employees')){
            foreach ($response as $training) {
                TrainingEmployee::create([
                    'id' => $training['id'],      
                    'employee_id' => $training['empleado_id'],
                    'training_id' => $training['capacitacion_id'],
                    //'date'=>Carbon::createFromTimeString(($training['fecha'])),
                    'score' => $training['nota'],
                    'taken' => $training['resuelto'],
                    'seen' => $training['lectura']
                ]);
            }
        }
        else{
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

    public function getAllContainer(){
        $url = "http://ccpcatalana.com/api/public/api/gerenciales/iso/contenedores/".$this->token;

        $response = Http::get($url)->json();

        if($this->firstTime('containers')){
            foreach ($response as $training) {
                Container::create([
                    'id' => $training['id'],      
                    'title' => $training['title'],
                    'active' => $training['active'],
                    'code' => $training['code'],
                    'created_at'=>Carbon::createFromTimeString(($training['date'])),
                ]);
            }
        }
        else{
            foreach ($response as $training) {
                Container::firstOrCreate([
                    'id' => $training['id'],      
                    'title' => $training['title'],
                    'active' => $training['active'],
                    'code' => $training['code'],
                    'created_at'=>Carbon::createFromTimeString(($training['date'])),
                ]);
            }
            $query = DB::select("SELECT id FROM containers");
            foreach ($query as $i => $after) {
                $flag = 0;
                foreach ($response as $j => $before) {
                    if($after->id == $before['id']){
                        $flag = 1;
                        break 1;
                    }
                }
                if($flag == 0){
                    Container::destroy($after->id);
                }
            }                    
        }        
    }
    
    public function getAllSubcontainer(){
        $url = "http://ccpcatalana.com/api/public/api/gerenciales/iso/subcontenedores/".$this->token;

        $response = Http::get($url)->json();

        if($this->firstTime('subcontainers')){
            foreach ($response as $training) {
                Subcontainer::create([
                    'id' => $training['id'],      
                    'title' => $training['title'],
                    'order' => $training['order'],
                    'back' => $training['back'],                
                    'code' => $training['code'],
                    'container_id' => $training['container_id'],
                    'created_at'=>Carbon::createFromTimeString(($training['date'])),
                ]);
            }
        }
        else{
            foreach ($response as $training) {
                Subcontainer::firstOrCreate([
                    'id' => $training['id'],      
                    'title' => $training['title'],
                    'order' => $training['order'],
                    'back' => $training['back'],                
                    'code' => $training['code'],
                    'container_id' => $training['container_id'],
                    'created_at'=>Carbon::createFromTimeString(($training['date'])),
                ]);
            }
            $query = DB::select("SELECT id FROM subcontainers");
            foreach ($query as $i => $after) {
                $flag = 0;
                foreach ($response as $j => $before) {
                    if($after->id == $before['id']){
                        $flag = 1;
                        break 1;
                    }
                }
                if($flag == 0){
                    Subcontainer::destroy($after->id);
                }
            }
        }        
    }

    public function getAllArchiveType(){
        $url = "http://ccpcatalana.com/api/public/api/gerenciales/iso/tipos/".$this->token;

        $response = Http::get($url)->json();

        if($this->firstTime('archive_types')){
            foreach ($response as $training) {
                ArchiveType::create([
                    'id' => $training['id'],      
                    'type' => $training['type'],
                    'code' => $training['code'],                
                ]);
            }
        }
        else{
            foreach ($response as $training) {
                ArchiveType::firstOrCreate([
                    'id' => $training['id'],      
                    'type' => $training['type'],
                    'code' => $training['code'],                
                ]);
            }
            $query = DB::select("SELECT id FROM archive_types");
            foreach ($query as $i => $after) {
                $flag = 0;
                foreach ($response as $j => $before) {
                    if($after->id == $before['id']){
                        $flag = 1;
                        break 1;
                    }
                }
                if($flag == 0){
                    ArchiveType::destroy($after->id);
                }
            }
        }        
    }

    public function getAllArchive(){
        $url = "http://ccpcatalana.com/api/public/api/gerenciales/iso/archivos/".$this->token;

        $response = Http::get($url)->json();

        if($this->firstTime('archives')){
            foreach ($response as $training) {
                Archive::create([
                    'id' => $training['id'],
                    'title' => $training['title'],
                    'version' => $training['version'],
                    'edition' => $training['edition'],
                    'active' => $training['active'],
                    'download_mark' => $training['download_marc'],
                    'download' => $training['download'],
                    'format' => $training['format'],
                    'container_id' => $training['container_id'],                
                    'subcontainer_id' => $training['subcontainer_id'],
                    'archive_type_id' => $training['filetype_id'],
                    'code' => $training['code'],
                    'created_at' => Carbon::createFromTimeString(($training['date'])),
                ]);
            }            
        }
        else{
            foreach ($response as $training) {
                Archive::firstOrCreate([
                    'id' => $training['id'],
                    'title' => $training['title'],
                    'version' => $training['version'],
                    'edition' => $training['edition'],
                    'active' => $training['active'],
                    'download_mark' => $training['download_marc'],
                    'download' => $training['download'],
                    'format' => $training['format'],
                    'container_id' => $training['container_id'],                
                    'subcontainer_id' => $training['subcontainer_id'],
                    'archive_type_id' => $training['filetype_id'],
                    'code' => $training['code'],
                    'created_at' => Carbon::createFromTimeString(($training['date'])),
                ]);
            }
            $query = DB::select("SELECT id FROM archives");
            foreach ($query as $i => $after) {
                $flag = 0;
                foreach ($response as $j => $before) {
                    if($after->id == $before['id']){
                        $flag = 1;
                        break 1;
                    }
                }
                if($flag == 0){
                    Archive::destroy($after->id);
                }
            }
        }        
    }   
    
    public function getAllHistory() {
        $url = "http://ccpcatalana.com/api/public/api/gerenciales/iso/historial/".$this->token;

        $response = Http::get($url)->json();

        if($this->firstTime('histories')){
            foreach ($response as $training) {
                History::create([
                    'id' => $training['id'],                
                    'container_id' => $training['container_id'],                
                    'subcontainer_id' => $training['subcontainer_id'],
                    'archive_type_id' => $training['typeFile_id'],
                    'archive_id' => $training['file_id'],
                    'employee_id' => $training['employee_id'],                
                    'date' => Carbon::createFromTimeString(($training['date'])),
                ]);
            }
        }
        else{
            foreach ($response as $training) {
                History::firstOrCreate([
                    'id' => $training['id'],                
                    'container_id' => $training['container_id'],                
                    'subcontainer_id' => $training['subcontainer_id'],
                    'archive_type_id' => $training['typeFile_id'],
                    'archive_id' => $training['file_id'],
                    'employee_id' => $training['employee_id'],                
                    'date' => Carbon::createFromTimeString(($training['date'])),
                ]);
            }
            $query = DB::select("SELECT id FROM histories");
            foreach ($query as $i => $after) {
                $flag = 0;
                foreach ($response as $j => $before) {
                    if($after->id == $before['id']){
                        $flag = 1;
                        break 1;
                    }
                }
                if($flag == 0){
                    History::destroy($after->id);
                }
            }
        }        
    }
    
    public function firstTime($table){
        $count = DB::table($table)->count();
        if ($count == 0){
            return true;
        }
        else{
            return false;
        }
    }
}