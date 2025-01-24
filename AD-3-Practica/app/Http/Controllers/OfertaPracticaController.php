<?php

namespace App\Http\Controllers;

use App\Models\OfertaDePractica;
use Illuminate\Http\Request;

class OfertaPracticaController extends Controller
{
    /**
     * GET /ofertas_practicas
     * Devuelve todas las ofertas
     */
    public function index()
    {
        // ->with('empresa','candidaturas') si quieres cargar relaciones
        return OfertaDePractica::all();
    }

    /**
     * GET /ofertas_practicas/{id}
     * Devuelve una oferta concreta
     */
    public function show($id)
    {
        $oferta = OfertaDePractica::findOrFail($id);
        // $oferta->load('empresa','candidaturas');
        return $oferta;
    }

    /**
     * POST /ofertas_practicas
     * Crea una nueva oferta de práctica
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'empresa_id'  => 'required|exists:empresa,id',
            'puesto'      => 'required|string|max:255',
            'duracion'    => 'nullable|integer',
            'requisitos'  => 'nullable|string',
            'descripcion' => 'nullable|string'
        ]);

        $oferta = OfertaDePractica::create($data);
        return response()->json($oferta, 201);
    }

    /**
     * PUT /ofertas_practicas/{id}
     * Actualizar una oferta
     */
    public function update(Request $request, $id)
    {
        $oferta = OfertaDePractica::findOrFail($id);

        $data = $request->validate([
            'puesto'      => 'sometimes|string',
            'duracion'    => 'sometimes|integer',
            'requisitos'  => 'sometimes|string',
            'descripcion' => 'sometimes|string'
        ]);

        $oferta->update($data);

        return response()->json($oferta, 200);
    }

    /**
     * DELETE /ofertas_practicas/{id}
     * Eliminar la oferta; en cascada se eliminan candidaturas si la FK está definida con cascade
     * O manualmente, si la FK no es en cascade, deberíamos borrar primero las candidaturas...
     */
    public function destroy($id)
    {
        $oferta = OfertaDePractica::findOrFail($id);
        // Si en tu migración definiste: 
        // $table->foreign('oferta_de_practica_id')->references('id')->on('oferta_de_practica')->onDelete('cascade');
        // entonces al eliminar la oferta, sus candidaturas se borran solas.
        $oferta->delete();

        return response()->json(['message' => 'Oferta y sus candidaturas eliminadas'], 200);
    }
}
