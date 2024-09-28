<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Usuario extends Authenticatable
{
    use HasFactory;

    // Nombre de la tabla
    protected $table = 'usuarios';

    // Campos permitidos para asignación masiva
    protected $fillable = [
        'rfc',
        'password',
    ];

    // Ocultar campos sensibles en las respuestas JSON
    protected $hidden = [
        'password',
    ];
}
