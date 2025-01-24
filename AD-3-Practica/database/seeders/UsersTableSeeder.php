<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;

class UsersTableSeeder extends Seeder
{
    public function run()
    {
        // 4 usuarios que serán alumnos
        User::create([
            'name'     => 'Alumno 1',
            'email'    => 'alumno1@example.com',
            'password' => bcrypt('secret'),
            'role'     => 'alumno'
        ]);
        User::create([
            'name'     => 'Alumno 2',
            'email'    => 'alumno2@example.com',
            'password' => bcrypt('secret'),
            'role'     => 'alumno'
        ]);
        User::create([
            'name'     => 'Alumno 3',
            'email'    => 'alumno3@example.com',
            'password' => bcrypt('secret'),
            'role'     => 'alumno'
        ]);
        User::create([
            'name'     => 'Alumno 4',
            'email'    => 'alumno4@example.com',
            'password' => bcrypt('secret'),
            'role'     => 'alumno'
        ]);

        // 2 usuarios que serán empresas
        User::create([
            'name'     => 'Empresa A',
            'email'    => 'empresaA@example.com',
            'password' => bcrypt('secret'),
            'role'     => 'empresa'
        ]);
        User::create([
            'name'     => 'Empresa B',
            'email'    => 'empresaB@example.com',
            'password' => bcrypt('secret'),
            'role'     => 'empresa'
        ]);
    }
}
