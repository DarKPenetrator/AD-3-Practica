<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;


// Controladores
use App\Http\Controllers\AlumnoController;
use App\Http\Controllers\EmpresaController;
use App\Http\Controllers\OfertaPracticaController;
use App\Http\Controllers\CandidaturaController;



Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');



// ========================
//       GET ENDPOINTS
// ========================

// 1) GET /alumnos (todos) o GET /alumnos/{id} (uno)
Route::get('alumnos', [AlumnoController::class, 'index']);
Route::get('alumnos/{id}', [AlumnoController::class, 'show']);

// 2) GET /empresas (todas) o GET /empresas/{id} (una)
Route::get('empresas', [EmpresaController::class, 'index']);
Route::get('empresas/{id}', [EmpresaController::class, 'show']);

// 3) GET /ofertas_practicas (todas) o GET /ofertas_practicas/{id}
Route::get('ofertas_practicas', [OfertaPracticaController::class, 'index']);
Route::get('ofertas_practicas/{id}', [OfertaPracticaController::class, 'show']);

// 4) GET /candidaturas/oferta/{id} (todas las candidaturas de una oferta)
Route::get('candidaturas/oferta/{oferta_id}', [CandidaturaController::class, 'byOferta']);

// 5) GET /alumnos/tutor/{tutor_id} (todos los alumnos que tengan ese tutor en alguna candidatura)
Route::get('alumnos/tutor/{tutor_id}', [AlumnoController::class, 'byTutor']);

// ========================
//      POST ENDPOINTS
// ========================

// 6) POST /alumno-usuario => crear de golpe User (role=alumno) + Alumno
Route::post('alumno-usuario', [AlumnoController::class, 'storeWithUser']);

// 7) POST /empresa-usuario => crear de golpe User (role=empresa) + Empresa
Route::post('empresa-usuario', [EmpresaController::class, 'storeWithUser']);

// 8) POST /ofertas_practicas => crear oferta
Route::post('ofertas_practicas', [OfertaPracticaController::class, 'store']);

// 9) POST /candidaturas => crear candidatura
Route::post('candidaturas', [CandidaturaController::class, 'store']);

// ========================
//     DELETE ENDPOINTS
// ========================

// 10) DELETE /candidaturas/{id} => eliminar candidatura
Route::delete('candidaturas/{id}', [CandidaturaController::class, 'destroy']);

// 11) DELETE /ofertas_practicas/{id} => eliminar oferta (y sus candidaturas asociadas en cascada)
Route::delete('ofertas_practicas/{id}', [OfertaPracticaController::class, 'destroy']);

// ========================
//      PUT ENDPOINTS
// ========================

// 12) PUT /alumnos/{id} => actualizar datos alumno
Route::put('alumnos/{id}', [AlumnoController::class, 'update']);

// 13) PUT /empresas/{id} => actualizar datos empresa
Route::put('empresas/{id}', [EmpresaController::class, 'update']);

// 14) PUT /ofertas_practicas/{id} => actualizar oferta
Route::put('ofertas_practicas/{id}', [OfertaPracticaController::class, 'update']);

// 15) PUT /candidaturas/{id} => actualizar candidatura
Route::put('candidaturas/{id}', [CandidaturaController::class, 'update']);