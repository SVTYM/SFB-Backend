<?php

namespace App\Models;

class Posicion
{
    public $id_posicion;
    public $posicion;
    public $descripcion;
    public $avance;
    public $partidas;

    // Constructor para inicializar los datos de una posición
    public function __construct($data = [])
    {
        $this->id_posicion = $data['id_posicion'] ?? null;
        $this->posicion = $data['posicion'] ?? null;
        $this->descripcion = $data['descripcion'] ?? null;
        $this->avance = $data['avance'] ?? null;
        $this->partidas = $data['partidas'] ?? null;
    }
}
