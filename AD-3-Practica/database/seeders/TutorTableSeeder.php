<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Tutor;

class TutorTableSeeder extends Seeder
{
    public function run()
    {
        Tutor::create([
            'nombre'   => 'Tutor Juan',
            'email'    => 'juan.tutor@example.com',
            'telefono' => '645123987'
        ]);

        Tutor::create([
            'nombre'   => 'Tutor María',
            'email'    => 'maria.tutor@example.com',
            'telefono' => '645987123'
        ]);
    }
}
