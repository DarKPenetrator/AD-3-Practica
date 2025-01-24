<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Empresa extends Model
{
    use HasFactory;

    protected $table = 'empresa';

    protected $fillable = [
        'user_id',
        'direccion',
        'telefono',
        'sector'
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function ofertasDePractica()
    {
        return $this->hasMany(OfertaDePractica::class, 'empresa_id');
    }
}
