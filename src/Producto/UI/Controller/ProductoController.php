<?php

namespace App\Producto\UI\Controller;

use App\Producto\Application\Command\CrearProductoCommand;
use App\Producto\Application\DTO\ProductoDTO;
use App\Producto\Application\Command\RecuperarProductoCommand;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;
use League\Tactician\CommandBus;

class ProductoController extends AbstractController
{
    public function __construct(private CommandBus $commandBus) {}

    #[Route('/producto', name: 'crear_producto', methods: ['POST'])]
    public function crear(Request $request): JsonResponse
    {
        $data = json_decode($request->getContent(), true);
        $dto = new ProductoDTO();
        $dto->nombre = $data['nombre'];
        $dto->referencia = $data['referencia'];
        $dto->observaciones = $data['observaciones'] ?? null;

        $this->commandBus->handle(new CrearProductoCommand($dto));
        return new JsonResponse(['status' => 'Producto creado'], 201);
    }

    #[Route('/producto/{id}', name: 'recuperar_producto', methods: ['GET'])]
    public function recuperar(string $id): JsonResponse
    {
        $producto = $this->commandBus->handle(new RecuperarProductoCommand($id));
        return new JsonResponse([
            'id' => (string) $producto->getId(),
            'nombre' => $producto->getNombre(),
            'referencia' => $producto->getReferencia(),
            'observaciones' => $producto->getObservaciones(),
        ]);
    }
}
