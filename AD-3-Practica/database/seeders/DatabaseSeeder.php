<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run()
    {
        // Importante el orden:
        // 1) Users (porque Alumno y Empresa dependen de User)
        // 2) CentroEducativo
        // 3) Tutor
        // 4) Empresa (necesita users con role=empresa)
        // 5) Alumno (necesita users con role=alumno y centros)
        // 6) OfertaDePractica (necesita empresa)
        // 7) Candidatura (necesita alumno, tutor y oferta)

        $this->call([
            UsersTableSeeder::class,
            CentroEducativoTableSeeder::class,
            TutorTableSeeder::class,
            EmpresaTableSeeder::class,
            AlumnoTableSeeder::class,
            OfertaDePracticaTableSeeder::class,
            CandidaturaTableSeeder::class,
        ]);
    }
}
