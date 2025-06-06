<?php

namespace App\Producto\Application\Command;

class RecuperarProductoCommand
{
    public function __construct(public string $id) {}
}