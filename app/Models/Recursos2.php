<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Recursos2 extends Model
{
    use HasFactory;
    protected $table = 'recursos2';
    public $timestamps = false;

    protected $fillable = [
        'posicion'
    ];
}
