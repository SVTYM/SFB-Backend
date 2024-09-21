<?php

namespace App\Models;


class Registro
{
    public $id_contrato;
    public $no_contrato;
    public $cliente;
    public $comprador;
    public $descripcion;
    public $fecha;
    public $estado;
    public $entrega;
    public $_estado;

    // Constructor para inicializar cada registro con los datos del JSON
    public function __construct($data = [])
    {
        $this->id_contrato = $data['id_contrato'] ?? null;
        $this->no_contrato = $data['no_contrato'] ?? null;
        $this->cliente = $data['cliente'] ?? null;
        $this->comprador = $data['comprador'] ?? null;
        $this->descripcion = $data['descripcion'] ?? null;
        $this->fecha = $data['fecha'] ?? null;
        $this->estado = $data['estado'] ?? null;
        $this->entrega = $data['entrega'] ?? null;
        $this->_estado = new Estado($data['_estado'] ?? []); // Mapeamos el objeto _estado
    }
}
