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
    $tactico =  Role::create(['name' => 'Táctico']);
    $estrategico =  Role::create(['name' => 'Estratégico']);    
    $admin = Role::create(['name' => 'Administrador']);

    //Permiso Página de inicio
    Permission::create(['name' => 'dashboard'])->syncRoles([$tactico, $estrategico, $admin]);

    //Permiso sistema
    Permission::create(['name' => 'system'])->syncRoles([$admin]);
    Permission::create(['name' => 'logs'])->syncRoles([$admin]);
    Permission::create(['name' => 'backup'])->syncRoles([$admin]);


    //Permisos imprimir reporte de usuarios
    Permission::create(['name' => 'retrieve_users'])->syncRoles([$admin]);
    Permission::create(['name' => 'create_users'])->syncRoles([$admin]);
    Permission::create(['name' => 'edit_users'])->syncRoles([$admin]);
    Permission::create(['name' => 'delete_users'])->syncRoles([$admin]);
    Permission::create(['name' => 'print_users'])->syncRoles([$admin]);

    //Permisos para ver,crear,editar y borrar roles
    Permission::create(['name' => 'retrieve_roles'])->syncRoles([$admin]);
    Permission::create(['name' => 'create_roles'])->syncRoles([$admin]);
    Permission::create(['name' => 'edit_roles'])->syncRoles([$admin]);
    Permission::create(['name' => 'delete_roles'])->syncRoles([$admin]);

    //Permisos para ver y asignar permisos
    Permission::create(['name' => 'retrieve_permissions'])->syncRoles([$admin]);
    Permission::create(['name' => 'assign_permissions'])->syncRoles([$admin]);

    //Permisos para módulo sugerencias
    Permission::create(['name' => 'suggestions_tactical'])->syncRoles([$tactico, $admin, $estrategico]);
    Permission::create(['name' => 'suggestions_estrategic'])->syncRoles([$admin, $estrategico]);

    //Permisos para módulo capacitaciones
    Permission::create(['name' => 'trainings_tactical'])->syncRoles([$tactico, $admin, $estrategico]);
    Permission::create(['name' => 'trainings_estrategic'])->syncRoles([$admin, $estrategico]);

    //Permisos para módulo publicaciones
    Permission::create(['name' => 'publications_tactical'])->syncRoles([$tactico, $admin, $estrategico]);
    Permission::create(['name' => 'publications_estrategic'])->syncRoles([$admin, $estrategico]);

    //Permisos para módulo iso
    Permission::create(['name' => 'iso_tactical'])->syncRoles([$tactico, $admin, $estrategico]);
    Permission::create(['name' => 'iso_estrategic'])->syncRoles([$admin, $estrategico]);

    //Permisos para módulo reloj-marcación
    Permission::create(['name' => 'clock_tactical'])->syncRoles([$tactico, $admin, $estrategico]);
    Permission::create(['name' => 'clock_estrategic'])->syncRoles([$admin, $estrategico]);
  }
}
