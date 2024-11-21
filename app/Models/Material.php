<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Material extends Model
{
    protected $fillable = [
        'nombre',
        'descripcion',
        'modelo',
        'estado',
        'observaciones',
        'costo_adquisicion',
        'imagen',
        'cantidad',
        'id_areas',
    ];

    public function area()
    {
        return $this->belongsTo(areas::class, 'id_areas');
    }

}


