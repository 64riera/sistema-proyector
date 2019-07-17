<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Solicitud extends Model
{

    protected $table = 'solicitudes';

    protected $primaryKey = 'id';

    protected $fillable = [
        'fecha',
        'solicitante',
        'ubicacion',
        'hora',
        'observaciones',
        'departamento'
    ];

    public $timestamps = false;

}
