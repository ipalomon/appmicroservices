<?php

namespace App\Producto\Domain\Event;

use App\Producto\Domain\Model\Producto;
use Symfony\Contracts\EventDispatcher\Event;

class ProductoCreado extends Event
{
    public function __construct(public Producto $producto) { }

    public function getProducto(): Producto{
        return $this->producto;
    }
}
