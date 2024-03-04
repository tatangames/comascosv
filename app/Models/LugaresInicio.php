<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LugaresInicio extends Model
{
    use HasFactory;
    protected $table = 'lugares_inicio';
    public $timestamps = false;

    protected $fillable = [
        'posicion'
    ];
}
