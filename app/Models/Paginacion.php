<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Registro;

class Paginacion extends Model
{
    use HasFactory;

    // Definimos las propiedades que representan los datos del JSON
    public $total;
    public $n_page;
    public $paginado;
    public $labels;
    public $css;
    public $registros;

    // Constructor para inicializar el modelo con los datos del JSON
    public function __construct($data = [])
    {
        parent::__construct(); // Esto asegura que Laravel siga manejando el modelo correctamente

        $this->total = $data['total'] ?? 0;
        $this->n_page = $data['n_page'] ?? 0;
        $this->paginado = $data['paginado'] ?? 0;
        $this->labels = $data['labels'] ?? [];
        $this->css = $data['css'] ?? [];
        $this->registros = array_map(function($registroData) {
            return new Registro($registroData);
        }, $data['registros'] ?? []);
    }
}
