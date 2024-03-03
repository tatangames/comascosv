<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PropiedadImagen360 extends Model
{
    use HasFactory;
    protected $table = 'propiedad_imagen360';
    public $timestamps = false;

    protected $fillable = [
        'posicion'
    ];
}
