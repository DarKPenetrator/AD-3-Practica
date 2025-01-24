<?php

namespace App\Http\Controllers;

use App\Models\Alumno;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class AlumnoController extends Controller
{
    /**
     * GET /alumnos
     * GET /alumnos/{id?}
     * Devuelve todos los alumnos o uno en concreto
     */
    public function index()
    {
        // Devuelve todos con sus relaciones (si quieres)
        // ->with('user','centroEducativo')
        return Alumno::all();
    }

    /**
     * GET /alumnos/{id}
     */
    public function show($id)
    {
        $alumno = Alumno::findOrFail($id);
        // Si quieres cargar relaciones:
        // $alumno->load('user','centroEducativo');
        return $alumno;
    }

    /**
     * GET /alumnos/tutor/{tutor_id}
     * Devuelve alumnos que tengan candidaturas con ese tutor
     */
    public function byTutor($tutor_id)
    {
        // Opción 1: usar la relación hasManyThrough que definiste (Alumno -> Candidatura -> Tutor)
        // Solo que la hasManyThrough normal obtiene "tutores" desde alumno. 
        // En este caso queremos la inversa: "alumnos" que estén con x tutor. 
        // Lo más sencillo: consultamos la tabla 'alumno' unida a 'candidatura' 
        return Alumno::whereHas('candidaturas', function($query) use ($tutor_id) {
            $query->where('tutor_id', $tutor_id);
        })->get();
    }

    /**
     * POST /alumno-usuario
     * Crear de golpe un user (role=alumno) y un alumno
     */
    public function storeWithUser(Request $request)
    {
        $data = $request->validate([
            // Campos de User
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|string|min:6',

            // Campos de Alumno
            'centro_educativo_id' => 'nullable|exists:centro_educativo,id',
            'carrera'            => 'required|string|max:255',
            'año_graduacion'     => 'nullable|integer',
            'telefono'           => 'nullable|string',
        ]);

        DB::beginTransaction();
        try {
            // 1) Crear el user con rol=alumno
            $user = User::create([
                'name'     => $data['name'],
                'email'    => $data['email'],
                'password' => Hash::make($data['password']),
                'role'     => 'alumno',
            ]);

            // 2) Crear el alumno
            $alumno = Alumno::create([
                'user_id'             => $user->id,
                'centro_educativo_id' => $data['centro_educativo_id'] ?? null,
                'carrera'             => $data['carrera'],
                'año_graduacion'      => $data['año_graduacion'] ?? null,
                'telefono'            => $data['telefono'] ?? null,
            ]);

            DB::commit();

            // Retornamos ambos en la respuesta
            return response()->json([
                'user'   => $user,
                'alumno' => $alumno
            ], 201);

        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json([
                'error' => 'Error creando alumno y usuario: ' . $e->getMessage()
            ], 500);
        }
    }

    /**
     * PUT /alumnos/{id}
     * Actualiza un alumno
     */
    public function update(Request $request, $id)
    {
        $alumno = Alumno::findOrFail($id);

        // Validar sólo los campos que queramos actualizar
        $data = $request->validate([
            'centro_educativo_id' => 'nullable|exists:centro_educativo,id',
            'carrera'            => 'sometimes|string|max:255',
            'año_graduacion'     => 'sometimes|integer',
            'telefono'           => 'sometimes|string',
        ]);

        $alumno->update($data);

        return response()->json($alumno, 200);
    }
}
