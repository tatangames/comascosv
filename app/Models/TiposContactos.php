<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TiposContactos extends Model
{
    use HasFactory;
    protected $table = 'tipos_contactos';
    public $timestamps = false;

}
