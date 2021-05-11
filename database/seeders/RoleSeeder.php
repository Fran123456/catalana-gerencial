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

      Permission::create(['name'=> 'dashboard'])->syncRoles([$tactico, $estrategico, $ambos, $recovery]);

      //Permisos para ver los roles y permisos
      Permission::create(['name'=>'retrieve_roles'])->syncRoles([$tactico, $estrategico, $ambos, $recovery]);
      Permission::create(['name'=>'create_roles'])->syncRoles([$tactico, $estrategico, $ambos, $recovery]);
      Permission::create(['name'=>'edit_roles'])->syncRoles([$tactico, $estrategico, $ambos, $recovery]);
      Permission::create(['name'=>'delete_roles'])->syncRoles([$tactico, $estrategico, $ambos, $recovery]);

      Permission::create(['name'=>'retrieve_permissions'])->syncRoles([$tactico,$estrategico,$ambos]);      
      Permission::create(['name'=>'assign_permissions'])->syncRoles([$tactico,$estrategico,$ambos]);      

      Permission::create(['name'=>'depruenauno']);
      Permission::create(['name'=>'depruenados']);
      Permission::create(['name'=>'depruenatersddfo']);
    }
}
