<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PropiedadTipoDetalle extends Model
{
    use HasFactory;
    protected $table = 'propiedad_tipo_detalle';
    public $timestamps = false;

    protected $fillable = [
        'posicion'
    ];
}
