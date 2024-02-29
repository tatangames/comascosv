<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PropiedadInicio extends Model
{
    use HasFactory;
    protected $table = 'propiedad_inicio';
    public $timestamps = false;

    protected $fillable = [
        'posicion'
    ];
    
}
