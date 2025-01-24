<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Alumno extends Model
{
    use HasFactory;

    // Nombre de la tabla si no coincide con el plural por defecto de Laravel
    protected $table = 'alumno';

    // Campos rellenables en create() o fill()
    protected $fillable = [
        'user_id',
        'centro_educativo_id',
        'carrera',
        'año_graduacion',
        'telefono'
    ];

    /**
     * Relación con el modelo User
     */
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    /**
     * Relación con el modelo CentroEducativo
     */
    public function centroEducativo()
    {
        return $this->belongsTo(CentroEducativo::class, 'centro_educativo_id');
    }

    /**
     * Relación con el modelo Candidatura
     */
    public function candidaturas()
    {
        return $this->hasMany(Candidatura::class, 'alumno_id');
    }

    /**
     * Relación HasManyThrough con Tutor a través de Candidatura
     */
    public function tutores()
    {
        return $this->hasManyThrough(
            Tutor::class,         // Modelo destino
            Candidatura::class,   // Tabla pivot
            'alumno_id',          // FK en la tabla candidatura apuntando a alumno
            'id',                 // FK en el modelo tutor
            'id',                 // PK local en Alumno
            'tutor_id'            // FK en la tabla candidatura apuntando a tutor
        );
    }
}
