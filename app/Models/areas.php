<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class areas extends Model
{
    protected $fillable = [
        'nombre',
        'descripcion',
    ];
}