<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PropiedadVideos extends Model
{
    use HasFactory;
    protected $table = 'propiedad_videos';
    public $timestamps = false;

    protected $fillable = [
        'posicion'
    ];
}
