<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ContactoVendedor extends Model
{
    use HasFactory;
    protected $table = 'contacto_vendedor';
    public $timestamps = false;

    protected $fillable = [
        'posicion'
    ];
}
