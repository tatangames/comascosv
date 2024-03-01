<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PropiedadPlanos extends Model
{
    use HasFactory;
    protected $table = 'propiedad_planos';
    public $timestamps = false;

    protected $fillable = [
        'posicion'
    ];

}
