<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Propiedad4Tag extends Model
{
    use HasFactory;
    protected $table = 'propiedad_4tag';
    public $timestamps = false;

    protected $fillable = [
        'posicion'
    ];

}
