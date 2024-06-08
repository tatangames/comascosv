<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Solicitudes extends Model
{
    use HasFactory;
    protected $table = 'solicitudes';
    public $timestamps = false;

    protected $fillable = [
        'posicion'
    ];
}
