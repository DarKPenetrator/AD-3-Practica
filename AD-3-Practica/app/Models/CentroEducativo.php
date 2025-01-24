<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CentroEducativo extends Model
{
    use HasFactory;

    protected $table = 'centro_educativo';

    protected $fillable = [
        'nombre',
        'direccion',
        'telefono',
        'email'
    ];

    public function alumnos()
    {
        return $this->hasMany(Alumno::class, 'centro_educativo_id');
    }
}
