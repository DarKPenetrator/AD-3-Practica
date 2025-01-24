<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OfertaDePractica extends Model
{
    use HasFactory;

    protected $table = 'oferta_de_practica';

    protected $fillable = [
        'empresa_id',
        'puesto',
        'duracion',
        'requisitos',
        'descripcion',
    ];

    public function empresa()
    {
        return $this->belongsTo(Empresa::class, 'empresa_id');
    }

    public function candidaturas()
    {
        return $this->hasMany(Candidatura::class, 'oferta_de_practica_id');
    }
}
