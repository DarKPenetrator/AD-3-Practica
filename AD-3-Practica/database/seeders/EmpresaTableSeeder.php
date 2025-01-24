<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Empresa;
use App\Models\User;

class EmpresaTableSeeder extends Seeder
{
    public function run()
    {
        // Empresa A
        $userA = User::where('email', 'empresaA@example.com')->first();

        Empresa::create([
            'user_id'   => $userA->id,
            'direccion' => 'Calle Empresa A, 10',
            'telefono'  => '910111213',
            'sector'    => 'Tecnología'
        ]);

        // Empresa B
        $userB = User::where('email', 'empresaB@example.com')->first();

        Empresa::create([
            'user_id'   => $userB->id,
            'direccion' => 'Av. Company B, 4',
            'telefono'  => '917654321',
            'sector'    => 'Educación'
        ]);
    }
}
