<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tutor extends Model
{
    use HasFactory;

    protected $table = 'tutor';

    protected $fillable = [
        'nombre',
        'email',
        'telefono'
    ];

    public function candidaturas()
    {
        return $this->hasMany(Candidatura::class, 'tutor_id');
    }
}
