<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class RentaInmueble extends Model
{
    protected $fillable = [
        'tipo_inmueble',
        'presupuesto',
        'personas',
        'duracion',
        'mascotas',
        'ninos',
        'lugar_trabajo',
        'descripcion'
    ];
}
