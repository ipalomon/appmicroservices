<?php
namespace App\Producto\Infrastructure\Persistence;

use App\Producto\Domain\Model\Producto;
use App\Producto\Domain\Model\ProductoId;
use App\Producto\Domain\Repository\ProductoRepositoryInterface;
use Doctrine\ORM\EntityManagerInterface;

class DoctrineProductoRepository implements ProductoRepositoryInterface
{
    public function __construct(private readonly EntityManagerInterface $em) {}

    public function guardar(Producto $producto): void
    {
        $this->em->persist($producto);
        $this->em->flush();
    }

    public function buscarPorId(ProductoId $id): ?Producto
    {
        return $this->em->getRepository(Producto::class)->find((string)$id);
    }

    public function eliminar(Producto $producto): void
    {
        $this->em->remove($producto);
        $this->em->flush();
    }
}

