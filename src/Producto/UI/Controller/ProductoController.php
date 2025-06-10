<?php

namespace App\Producto\UI\Controller;

use App\Producto\Application\Command\CrearProductoCommand;
use League\Tactician\CommandBus;
use App\Producto\Application\DTO\ProductoDTO;
use App\Producto\Application\Command\RecuperarProductoCommand;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;

class ProductoController extends AbstractController
{
    #[Route('/producto', name: 'crear_producto', methods: ['POST'])]
    public function crear(Request $request, CommandBus $commandBus): JsonResponse
    {
        $data = json_decode($request->getContent(), true);
        $dto = new ProductoDTO();
        $dto->nombre = $data['nombre'];
        $dto->referencia = $data['referencia'];
        $dto->observaciones = $data['observaciones'] ?? null;

        $command = new CrearProductoCommand($dto);

        $commandBus->handle($command);
        return new JsonResponse(['status' => 'Producto creado'], 201);
    }

    #[Route('/producto/{id}', name: 'recuperar_producto', methods: ['GET'])]
    public function recuperar(string $id, CommandBus $commandBus): JsonResponse
    {
        $producto = $commandBus->handle(new RecuperarProductoCommand($id));
        return new JsonResponse([
            'id' => (string) $producto->getId(),
            'nombre' => $producto->getNombre(),
            'referencia' => $producto->getReferencia(),
            'observaciones' => $producto->getObservaciones(),
        ]);
    }
}
