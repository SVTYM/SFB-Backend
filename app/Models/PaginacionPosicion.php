<?php

namespace App\Models;

class PaginacionPosicion
{
    public $total;
    public $n_page;
    public $paginado;
    public $labels;
    public $css;
    public $registros;

    // Constructor para inicializar el modelo con los datos del JSON
    public function __construct($data = [])
    {
        $this->total = $data['total'] ?? '0';
        $this->n_page = $data['n_page'] ?? 0;
        $this->paginado = $data['paginado'] ?? 0;
        $this->labels = $data['labels'] ?? [];
        $this->css = $data['css'] ?? [];
        $this->registros = array_map(function ($registroData) {
            return new Posicion($registroData); // Usamos la clase Posicion para mapear los registros
        }, $data['registros'] ?? []);
    }
}
