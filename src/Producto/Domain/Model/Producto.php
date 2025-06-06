<?php

namespace App\Producto\Domain\Model;

class Producto
{
    private ProductoId $id;
    private string $nombre;
    private string $referencia;
    private ?string $observaciones;

    public function __construct(ProductoId $id, string $nombre, string $referencia, ?string $observaciones)
    {
        $this->assertValidNombre($nombre);
        $this->id = $id;
        $this->nombre = $nombre;
        $this->referencia = $referencia;
        $this->observaciones = $observaciones;
    }

    private function assertValidNombre(string $nombre): void
    {
        if (empty($nombre)) {
            throw new \InvalidArgumentException('El nombre no puede estar vacío');
        }
    }

    public function getId(): ProductoId { return $this->id; }
    public function getNombre(): string { return $this->nombre; }
    public function getReferencia(): string { return $this->referencia; }
    public function getObservaciones(): ?string { return $this->observaciones; }
}