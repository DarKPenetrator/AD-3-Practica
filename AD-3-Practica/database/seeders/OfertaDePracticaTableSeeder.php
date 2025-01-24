<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\OfertaDePractica;
use App\Models\Empresa;
use App\Models\User;

class OfertaDePracticaTableSeeder extends Seeder
{
    public function run()
    {
        // Localizamos las 2 empresas
        $empresaA = Empresa::first(); // la primera que creamos (Empresa A)
        $empresaB = Empresa::skip(1)->first(); // la segunda

        // 3 ofertas de Empresa A
        OfertaDePractica::create([
            'empresa_id'  => $empresaA->id,
            'puesto'      => 'Becario Full Stack',
            'duracion'    => 6,
            'requisitos'  => 'PHP, Laravel, JS, ganas de aprender',
            'descripcion' => 'Dar soporte al equipo de desarrollo web.'
        ]);

        OfertaDePractica::create([
            'empresa_id'  => $empresaA->id,
            'puesto'      => 'Becario Data Analyst',
            'duracion'    => 3,
            'requisitos'  => 'Python, SQL, PowerBI.',
            'descripcion' => 'Análisis de datos y generación de dashboards.'
        ]);

        OfertaDePractica::create([
            'empresa_id'  => $empresaA->id,
            'puesto'      => 'Becario Front-End',
            'duracion'    => 4,
            'requisitos'  => 'HTML, CSS, Vue.js/React.',
            'descripcion' => 'Maquetación y desarrollo front.'
        ]);

        // 1 oferta de Empresa B
        OfertaDePractica::create([
            'empresa_id'  => $empresaB->id,
            'puesto'      => 'Becario Comunicación',
            'duracion'    => 5,
            'requisitos'  => 'Habilidades de redacción y diseño.',
            'descripcion' => 'Apoyo en campañas de marketing y redes sociales.'
        ]);
    }
}
