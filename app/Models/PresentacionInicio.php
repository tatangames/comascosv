<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PresentacionInicio extends Model
{
    use HasFactory;
    protected $table = 'presentacion_inicio';
    public $timestamps = false;

    protected $fillable = [
        'posicion'
    ];
}
