<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\CentroEducativo;

class CentroEducativoTableSeeder extends Seeder
{
    public function run()
    {
        CentroEducativo::create([
            'nombre'    => 'Instituto XYZ',
            'direccion' => 'Calle Falsa 123',
            'telefono'  => '600111222',
            'email'     => 'info@institutexyz.com'
        ]);

        CentroEducativo::create([
            'nombre'    => 'Academia ABC',
            'direccion' => 'Av. Principal 45',
            'telefono'  => '600333444',
            'email'     => 'contacto@academiaabc.org'
        ]);
    }
}
