<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DetallesContacto extends Model
{
    use HasFactory;
    protected $table = 'detalles_contacto';
    public $timestamps = false;

    protected $fillable = [
        'posicion'
    ];
}
