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
        'id_empleado', // Asegúrate de incluir este campo
        'rfc',
        'password',
    ];

    // Ocultar campos sensibles
    protected $hidden = [
        'password',
    ];
}
