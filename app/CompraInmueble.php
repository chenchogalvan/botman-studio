<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CompraInmueble extends Model
{
    protected $fillable = [
        'nombre_completo',
        'telefono',
        'correo',
        'tipo_inmueble',
        'presupuesto',
        'ubicacion',
        'recursos_propios',
        'tipo_credito',
        'tipo_credito_especifico',
        'descripcion'
    ];
}
