<?php

namespace App\Models;

use App\Models\Estado;

class Registro
{
    public $id_contrato;
    public $no_contrato;
    public $cliente;
    public $comprador;
    public $_comprador;
    public $descripcion;
    public $fecha;
    public $estado;
    public $_estado;
    public $entrega;

    public function __construct($data = [])
    {
        $this->id_contrato = $data['id_contrato'] ?? null;
        $this->no_contrato = $data['no_contrato'] ?? null;
        $this->cliente = $data['cliente'] ?? null;
        $this->comprador = $data['comprador'] ?? null;
        $this->_comprador = $data['_comprador'] ?? null;
        $this->descripcion = $data['descripcion'] ?? null;
        $this->fecha = $data['fecha'] ?? null;
        $this->estado = $data['estado'] ?? null;
        $this->_estado = new Estado($data['_estado'] ?? []);
        $this->entrega = $data['entrega'] ?? null;
    }
}
