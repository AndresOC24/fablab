<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Voluntario extends Model
{
    protected $fillable = [
        'nombre',
        'apellido',
        'ci',
        'fecha_nacimiento',
        'email',
        'estado',
        'telefono',
        'universidad',
        'extra',
    ];

    public function areas()
    {
        return $this->belongsToMany(Area::class, 'area_voluntario', 'voluntario_id', 'area_id');
    }

}
