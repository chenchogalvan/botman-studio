<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class RentaPropiedad extends Model
{
    protected $fillable = [
        'nombre_completo',
        'telefono',
        'correo',
        'tipo_inmueble',
        'presupuesto',
        'ubicacion',
        'duracion_contrato',
        'acepta_mascotas',
        'acepta_ninos',
        'descripcion'
    ];
}
