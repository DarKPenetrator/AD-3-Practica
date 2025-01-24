<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Alumno;
use App\Models\User;
use App\Models\CentroEducativo;

class AlumnoTableSeeder extends Seeder
{
    public function run()
    {
        // Obtenemos todos los centros
        $centros = CentroEducativo::all();

        // Alumno 1
        $user1 = User::where('email','alumno1@example.com')->first();
        Alumno::create([
            'user_id'             => $user1->id,
            'centro_educativo_id' => $centros->random()->id,
            'carrera'             => 'Ingeniería Informática',
            'año_graduacion'      => 2025,
            'telefono'            => '600000001'
        ]);

        // Alumno 2
        $user2 = User::where('email','alumno2@example.com')->first();
        Alumno::create([
            'user_id'             => $user2->id,
            'centro_educativo_id' => $centros->random()->id,
            'carrera'             => 'Marketing Digital',
            'año_graduacion'      => 2026,
            'telefono'            => '600000002'
        ]);

        // Alumno 3
        $user3 = User::where('email','alumno3@example.com')->first();
        Alumno::create([
            'user_id'             => $user3->id,
            'centro_educativo_id' => $centros->random()->id,
            'carrera'             => 'Administración y Dirección de Empresas',
            'año_graduacion'      => 2024,
            'telefono'            => '600000003'
        ]);

        // Alumno 4
        $user4 = User::where('email','alumno4@example.com')->first();
        Alumno::create([
            'user_id'             => $user4->id,
            'centro_educativo_id' => $centros->random()->id,
            'carrera'             => 'Telecomunicaciones',
            'año_graduacion'      => 2027,
            'telefono'            => '600000004'
        ]);
    }
}
