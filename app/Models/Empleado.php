<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Empleado extends Model
{
    use HasFactory;

    // Nombre de la tabla
    protected $table = 'empleados';

    // Definir la clave primaria
    protected $primaryKey = 'id_empleado';

    // Desactivar las columnas `created_at` y `updated_at` si no las usas
    public $timestamps = true;

    // Campos que pueden ser asignados masivamente
    protected $fillable = [
        'tipo_empleado',
        'nombres',
        'clave',
        'rfc',
        'puesto',
        'email',
        'estado',
    ];
}
