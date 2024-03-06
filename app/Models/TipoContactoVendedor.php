<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TipoContactoVendedor extends Model
{
    use HasFactory;
    protected $table = 'tipo_contacto_vendedor';
    public $timestamps = false;
}
