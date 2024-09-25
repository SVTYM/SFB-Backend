<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Tarea extends Model
{
    protected $table = 'tareas';

    // Especificar que la clave primaria es 'id_tarea'
    protected $primaryKey = 'id_tarea';

    // Los campos que se pueden asignar de manera masiva
    protected $fillable = [
        'descripcion',
        'fecha_inicio',
        'fecha_finalizacion',
        'avance',
        'estado',
        'imagenes',
        'id_contrato',
    ];

    // Relación inversa con Contrato
    public function contrato()
    {
        return $this->belongsTo(Contrato::class, 'id_contrato', 'id_contrato');
    }
}
