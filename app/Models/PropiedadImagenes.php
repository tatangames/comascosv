<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PropiedadImagenes extends Model
{
    use HasFactory;
    protected $table = 'propiedad_imagenes';
    public $timestamps = false;

    protected $fillable = [
        'posicion'
    ];
}
