<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use App\Models\User;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user =  User::create([
          'name' => 'Francisco Navas',
          'email' => 'navasfran98@gmail.com',
          'password' => Hash::make('paginaazul'),
        ])->assignRole('Tactico y Estrategico');

        User::create([
          'name' => 'Andrés Castro',
          'email' => 'andres.castro2503@gmail.com',
          'password' => Hash::make('paginaazul'),
        ])->assignRole('Tactico y Estrategico');


        User::create([
          'name' => 'Luis Pérez',
          'email' => 'admin@mail.com',
          'password' => Hash::make('paginaazul'),
        ])->assignRole('Tactico y Estrategico');
    }
}
