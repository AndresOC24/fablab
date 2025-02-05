<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Prestamo extends Model
{
    use HasFactory;

    // Tabla asociada
    protected $table = 'prestamos';

    // Campos asignables
    protected $fillable = [
        'voluntarios_id',
        'material_id',
        'cantidad',
        'fecha_prestamo',
        'fecha_devolucion',
        'estado',
        'observaciones',
    ];

    protected $casts = [
        'estado' => 'boolean',
    ];

    // Relación con voluntarios
    public function voluntario()
    {
        return $this->belongsTo(Voluntario::class, 'voluntarios_id');
    }

    // Relación con materiales
    public function material()
    {
        return $this->belongsTo(Material::class, 'material_id');
    }
}
