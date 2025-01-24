<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Candidatura;
use App\Models\Alumno;
use App\Models\OfertaDePractica;
use App\Models\Tutor;

class CandidaturaTableSeeder extends Seeder
{
    public function run()
    {
        // Cogemos algunos alumnos
        $alumno1 = Alumno::first();               // ID1
        $alumno2 = Alumno::skip(1)->first();      // ID2
        $alumno3 = Alumno::skip(2)->first();      // ID3
        $alumno4 = Alumno::skip(3)->first();      // ID4

        // Cogemos algunas ofertas
        $oferta1 = OfertaDePractica::first();         // Becario Full Stack
        $oferta2 = OfertaDePractica::skip(1)->first();// Becario Data Analyst
        $oferta3 = OfertaDePractica::skip(2)->first();// Becario Front-End
        $oferta4 = OfertaDePractica::skip(3)->first();// Becario Comunicación

        // Cogemos tutores
        $tutor1 = Tutor::first(); // Tutor Juan
        $tutor2 = Tutor::skip(1)->first(); // Tutor María

        // 1) Candidatura #1
        Candidatura::create([
            'alumno_id'             => $alumno1->id,
            'oferta_de_practica_id' => $oferta1->id,
            'tutor_id'              => $tutor1->id,
            'estado'                => 'pendiente',
            'comentarios'           => 'Alumno 1 se postula para Full Stack',
            'fecha_candidatura'     => now()
        ]);

        // 2) Candidatura #2 (mismo tutor => tutor1)
        Candidatura::create([
            'alumno_id'             => $alumno2->id,
            'oferta_de_practica_id' => $oferta1->id,
            'tutor_id'              => $tutor1->id,
            'estado'                => 'aceptada',
            'comentarios'           => 'Alumno 2 también interesado en Full Stack',
            'fecha_candidatura'     => now()
        ]);

        // 3) Candidatura #3 (tutor distinto => tutor2)
        Candidatura::create([
            'alumno_id'             => $alumno3->id,
            'oferta_de_practica_id' => $oferta2->id,
            'tutor_id'              => $tutor2->id,
            'estado'                => 'pendiente',
            'comentarios'           => 'Alumno 3 se postula para Data Analyst',
            'fecha_candidatura'     => now()
        ]);

        // 4) Candidatura #4 (sin tutor)
        Candidatura::create([
            'alumno_id'             => $alumno4->id,
            'oferta_de_practica_id' => $oferta3->id,
            'tutor_id'              => null,
            'estado'                => 'rechazada',
            'comentarios'           => 'Alumno 4 descartado para Front-End',
            'fecha_candidatura'     => now()
        ]);

        // Si quieres añadir más, adelante
    }
}
    