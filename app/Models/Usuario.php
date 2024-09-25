<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Usuario extends Model
{
    protected $table = 'usuarios';

    // Especificar que la clave primaria es 'id_usuario'
    protected $primaryKey = 'id_usuario';

    // Los campos que se pueden asignar de manera masiva
    protected $fillable = [
        'usuario',
        'password',
        'nombre',
        'estado',
        'perfil',
        'id_empleado',
    ];

    // Relación muchos a muchos con Contratos
    public function contratos()
    {
        return $this->belongsToMany(Contrato::class, 'contrato_usuario', 'id_usuario', 'id_contrato');
    }
}
