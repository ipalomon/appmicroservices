<?php

namespace App\Producto\Application\Command;

use App\Producto\Application\DTO\ProductoDTO;
class CrearProductoCommand
{
    public function __construct(public ProductoDTO $dto) {}
}