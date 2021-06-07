<?php

namespace Database\Seeders;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Illuminate\Database\Seeder;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      $tactico =  Role::create(['name'=>'Tactico']);
      $estrategico=  Role::create(['name'=>'Estategico']);
      $ambos =  Role::create(['name'=>'Tactico y Estrategico']);
      $recovery = Role::create(['name'=>'Recovery']);

      //Permiso Página de inicio
      Permission::create(['name'=> 'dashboard'])->syncRoles([$tactico, $estrategico, $ambos, $recovery]);

      //Permisos imprimir reporte de usuarios
      Permission::create(['name'=> 'print_users'])->syncRoles([$ambos]);

      //Permisos para ver,crear,editar y borrar roles
      Permission::create(['name'=>'retrieve_roles'])->syncRoles([$tactico, $estrategico, $ambos, $recovery]);
      Permission::create(['name'=>'create_roles'])->syncRoles([$tactico, $estrategico, $ambos, $recovery]);
      Permission::create(['name'=>'edit_roles'])->syncRoles([$tactico, $estrategico, $ambos, $recovery]);
      Permission::create(['name'=>'delete_roles'])->syncRoles([$tactico, $estrategico, $ambos, $recovery]);

      //Permisos para ver y asignar permisos
      Permission::create(['name'=>'retrieve_permissions'])->syncRoles([$tactico,$estrategico,$ambos]);      
      Permission::create(['name'=>'assign_permissions'])->syncRoles([$tactico,$estrategico,$ambos]);      

      //Permisos para módulo sugerencias
      Permission::create(['name'=>'suggestions_tactico'])->syncRoles([$tactico,$ambos]);
      Permission::create(['name'=>'suggestions_estratégico'])->syncRoles([$ambos,$estrategico]);
    }
}
