<?php

namespace App\Models;


class Estado
{
    public $text;
    public $html;
    public $id;
    public $class;

    // Constructor para inicializar el objeto _estado
    public function __construct($data = [])
    {
        $this->text = $data['text'] ?? null;
        $this->html = $data['html'] ?? null;
        $this->id = $data['id'] ?? null;
        $this->class = $data['class'] ?? [];
    }
}
