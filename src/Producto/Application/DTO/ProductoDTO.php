<?php

namespace App\Producto\Application\DTO;

class ProductoDTO
{
    public string $nombre;
    public string $referencia;
    public ?string $observaciones = null;
}