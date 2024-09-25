<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Contrato extends Model
{
    protected $table = 'contratos';

    // Especificar que la clave primaria es 'id_contrato'
    protected $primaryKey = 'id_contrato';

    // Los campos que se pueden asignar de manera masiva
    protected $fillable = [
        'descripcion',
        'id_cliente',
        'fecha_inicio',
        'fecha_final',
        'estado',
        'avance',
    ];

    // Relación uno a muchos con Tareas
    public function tareas()
    {
        return $this->hasMany(Tarea::class, 'id_contrato', 'id_contrato');
    }

    // Relación muchos a muchos con Usuarios
    public function usuarios()
    {
        return $this->belongsToMany(Usuario::class, 'contrato_usuario', 'id_contrato', 'id_usuario');
    }
}
