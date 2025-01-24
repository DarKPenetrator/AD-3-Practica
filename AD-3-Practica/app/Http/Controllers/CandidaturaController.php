<?php

namespace App\Http\Controllers;

use App\Models\Candidatura;
use Illuminate\Http\Request;

class CandidaturaController extends Controller
{
    /**
     * GET /candidaturas/oferta/{oferta_id}
     * Todas las candidaturas de una oferta en concreto
     */
    public function byOferta($oferta_id)
    {
        // Filtrar candidaturas por oferta_de_practica_id
        return Candidatura::where('oferta_de_practica_id', $oferta_id)->get();
    }

    /**
     * POST /candidaturas
     * Crear una nueva candidatura
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'alumno_id'             => 'required|exists:alumno,id',
            'oferta_de_practica_id' => 'required|exists:oferta_de_practica,id',
            'tutor_id'              => 'nullable|exists:tutor,id',
            'estado'                => 'nullable|in:pendiente,aceptada,rechazada',
            'comentarios'           => 'nullable|string',
            'fecha_candidatura'     => 'nullable|date'
        ]);

        $candidatura = Candidatura::create($data);
        return response()->json($candidatura, 201);
    }

    /**
     * DELETE /candidaturas/{id}
     * Eliminar una candidatura
     */
    public function destroy($id)
    {
        $candidatura = Candidatura::findOrFail($id);
        $candidatura->delete();

        return response()->json(['message' => 'Candidatura eliminada con éxito'], 200);
    }

    /**
     * PUT /candidaturas/{id}
     * Actualizar candidatura
     */
    public function update(Request $request, $id)
    {
        $candidatura = Candidatura::findOrFail($id);

        $data = $request->validate([
            'tutor_id'          => 'sometimes|exists:tutor,id',
            'estado'            => 'sometimes|in:pendiente,aceptada,rechazada',
            'comentarios'       => 'sometimes|string',
            'fecha_candidatura' => 'sometimes|date'
        ]);

        $candidatura->update($data);

        return response()->json($candidatura, 200);
    }
}
