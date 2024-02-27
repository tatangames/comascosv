<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PropiedadEtiqueta extends Model
{
    use HasFactory;
    protected $table = 'propiedad_etiqueta';
    public $timestamps = false;

    protected $fillable = [
        'posicion'
    ];
}
