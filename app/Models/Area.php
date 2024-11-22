<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Area extends Model
{
    protected $fillable = [
        'nombre',
        'descripcion',
    ];

    public function maquinas()
    {
        return $this->hasMany(Maquina::class, 'id_areas');
    }
}
