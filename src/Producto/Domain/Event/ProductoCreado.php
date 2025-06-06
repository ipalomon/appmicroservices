<?php

namespace App\Producto\Domain\Event;

use App\Producto\Domain\Model\Producto;

class ProductoCreado
{
    public function __construct(public Producto $producto) {}
}
