<?php

declare(strict_types=1);

namespace App\Models;

use App\Dto\TriangleParametersDto;

final readonly class Triangle implements ShapeInterface
{
    public function __construct(
        private TriangleParametersDto $dto,
    ) {
    }

    public function calculate(): float
    {
        return ($this->dto->height * $this->dto->base) / 2;
    }
}