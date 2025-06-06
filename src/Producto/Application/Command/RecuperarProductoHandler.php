<?php
namespace App\Producto\Application\Command;

use App\Producto\Domain\Repository\ProductoRepositoryInterface;
use App\Producto\Domain\Model\ProductoId;
use App\Producto\Domain\Exception\ProductoNoEncontradoException;

class RecuperarProductoHandler
{
    public function __construct(private ProductoRepositoryInterface $repository) {}

    public function __invoke(RecuperarProductoCommand $command)
    {
        $producto = $this->repository->buscarPorId(new ProductoId($command->id));

        if (!$producto) {
            throw new ProductoNoEncontradoException($command->id);
        }

        return $producto;
    }
}
