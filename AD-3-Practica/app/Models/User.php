<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use HasFactory;

    protected $fillable = [
        'name',
        'email',
        'password',
        'role'
    ];

    // Si role = 'alumno', tendrá una relación con la tabla "alumno"
    public function alumno()
    {
        return $this->hasOne(Alumno::class, 'user_id');
    }

    // Si role = 'empresa', tendrá una relación con la tabla "empresa"
    public function empresa()
    {
        return $this->hasOne(Empresa::class, 'user_id');
    }
}
