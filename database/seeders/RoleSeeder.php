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
      $recovery = Role::create(['name'=>'recovery']);

      Permission::create(['name'=> 'dashboard'])->syncRoles([$tactico, $estrategico, $ambos, $recovery]);
    }
}
