<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Maquina extends Model
{
    protected $fillable = [
        'nombre',
        'descripcion',
        'modelo',
        'numero_serie',
        'id_areas', // Relación con áreas
        'observaciones',
        'imagen',
    ];

    public function area()
    {
        return $this->belongsTo(Area::class, 'id_areas');
    }
}
