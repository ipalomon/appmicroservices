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
        private ProductoRepositoryInterface $repository,
        private EventDispatcherInterface $dispatcher
    ) {}

    public function __invoke(CrearProductoCommand $command): void
    {
        $id = new ProductoId();
        $dto = $command->dto;

        $producto = new Producto($id, $dto->nombre, $dto->referencia, $dto->observaciones);
        $this->repository->guardar($producto);
        $this->dispatcher->dispatch(new ProductoCreado($producto));
    }
}
