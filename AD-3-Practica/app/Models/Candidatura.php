<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Candidatura extends Model
{
    use HasFactory;

    protected $table = 'candidatura';

    protected $fillable = [
        'alumno_id',
        'oferta_de_practica_id',
        'tutor_id',
        'estado',
        'comentarios',
        'fecha_candidatura'
    ];

    public function alumno()
    {
        return $this->belongsTo(Alumno::class, 'alumno_id');
    }

    public function ofertaDePractica()
    {
        return $this->belongsTo(OfertaDePractica::class, 'oferta_de_practica_id');
    }

    public function tutor()
    {
        return $this->belongsTo(Tutor::class, 'tutor_id');
    }
}
