<?php

namespace App\Models;

class Paginacion
{
    public $total;
    public $n_page;
    public $paginado;
    public $labels;
    public $css;
    public $registros;

    // Constructor para inicializar la clase con los datos del JSON
    public function __construct($data = [])
    {
        $this->total = $data['total'] ?? '0'; // total en formato string
        $this->n_page = $data['n_page'] ?? 0;
        $this->paginado = $data['paginado'] ?? 0;
        $this->labels = $data['labels'] ?? [];
        $this->css = $data['css'] ?? [];
        $this->registros = array_map(function($registroData) {
            return new Registro($registroData); // Usamos la clase Registro para mapear los datos
        }, $data['registros'] ?? []);
    }
}
