<?php
namespace App\Producto\Domain\Repository;

use App\Producto\Domain\Model\Producto;
use App\Producto\Domain\Model\ProductoId;

interface ProductoRepositoryInterface
{
    public function guardar(Producto $producto): void;

    public function buscarPorId(ProductoId $id): ?Producto;

    public function eliminar(Producto $producto): void;
}
