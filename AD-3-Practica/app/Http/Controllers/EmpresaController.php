<?php

namespace App\Http\Controllers;

use App\Models\Empresa;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class EmpresaController extends Controller
{
    /**
     * GET /empresas
     * Devuelve todas las empresas
     */
    public function index()
    {
        // Si quieres eager loading: ->with('user','ofertasDePractica')->get()
        return Empresa::all();
    }

    /**
     * GET /empresas/{id}
     * Devuelve una sola empresa
     */
    public function show($id)
    {
        $empresa = Empresa::findOrFail($id);
        // $empresa->load('user','ofertasDePractica');
        return $empresa;
    }

    /**
     * POST /empresa-usuario
     * Crear de golpe User (role=empresa) + Empresa
     */
    public function storeWithUser(Request $request)
    {
        $data = $request->validate([
            // Datos de User
            'name'     => 'required|string|max:255',
            'email'    => 'required|email|unique:users,email',
            'password' => 'required|string|min:6',

            // Datos de Empresa
            'direccion' => 'required|string',
            'telefono'  => 'required|string',
            'sector'    => 'required|string',
        ]);

        DB::beginTransaction();
        try {
            // 1) Crear user con rol=empresa
            $user = User::create([
                'name'     => $data['name'],
                'email'    => $data['email'],
                'password' => Hash::make($data['password']),
                'role'     => 'empresa',
            ]);

            // 2) Crear empresa
            $empresa = Empresa::create([
                'user_id'   => $user->id,
                'direccion' => $data['direccion'],
                'telefono'  => $data['telefono'],
                'sector'    => $data['sector'],
            ]);

            DB::commit();

            return response()->json([
                'user'    => $user,
                'empresa' => $empresa
            ], 201);

        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json([
                'error' => 'Error creando empresa y usuario: ' . $e->getMessage()
            ], 500);
        }
    }

    /**
     * PUT /empresas/{id}
     * Actualiza datos de empresa
     */
    public function update(Request $request, $id)
    {
        $empresa = Empresa::findOrFail($id);

        $data = $request->validate([
            'direccion' => 'sometimes|string',
            'telefono'  => 'sometimes|string',
            'sector'    => 'sometimes|string',
        ]);

        $empresa->update($data);

        return response()->json($empresa, 200);
    }
}
