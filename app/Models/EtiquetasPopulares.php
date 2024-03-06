<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EtiquetasPopulares extends Model
{
    use HasFactory;
    protected $table = 'etiquetas_populares';
    public $timestamps = false;
}
