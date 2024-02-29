<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PropiedadItem extends Model
{
    use HasFactory;
    protected $table = 'propiedad_item';
    public $timestamps = false;

    protected $fillable = [
        'posicion'
    ];
}
