<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class VentaPropiedad extends Model
{
    protected $fillable = [
        'ubicacion',
        'precio',
        'adeudo',
        'numero_credito',
        'adeudo_monto',
        'institucion_financiera',
        'terreno_metros',
        'construidos_metros',
        'escrituras',
        'descripcion',
    ];
}
