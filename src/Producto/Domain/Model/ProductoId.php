<?php
namespace App\Producto\Domain\Model;

use Ramsey\Uuid\Uuid;

class ProductoId
{
    private string $uuid;

    public function __construct(string $uuid = null)
    {
        $this->uuid = $uuid ?? Uuid::uuid4()->toString();
    }

    public function __toString(): string
    {
        return $this->uuid;
    }

    public function getUuId(): string
    {
        return $this->uuid;
    }
}
