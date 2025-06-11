<?php
namespace App\Producto\Application\Command;

use App\Producto\Domain\Model\Producto;
use App\Producto\Domain\Model\ProductoId;
use App\Producto\Domain\Repository\ProductoRepositoryInterface;
use Symfony\Component\EventDispatcher\EventDispatcherInterface;
use App\Producto\Domain\Event\ProductoCreado;

class CrearProductoHandler
{
    public function __construct(
        private readonly ProductoRepositoryInterface $repository,
        private readonly EventDispatcherInterface    $dispatcher
    ) {}

    public function handle(CrearProductoCommand $command): Producto
    {
        $id = new ProductoId();
        $dto = $command->dto;

        $producto = new Producto($id, $dto->nombre, $dto->referencia, $dto->observaciones);

        $this->repository->guardar($producto);
        $productoGuardadoEvento = $this->dispatcher->dispatch(new ProductoCreado($producto));

        return $productoGuardadoEvento->getProducto();
    }
}
