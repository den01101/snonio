<?php

declare(strict_types=1);

namespace App\Models;

use App\Dto\TrapezoidParametersDto;

final readonly class Trapezoid implements ShapeInterface
{
    public function __construct(
        private TrapezoidParametersDto $dto,
    ) {
    }

    public function calculate(): float
    {
        return ($this->dto->top_base + $this->dto->bottom_base) / 2 * $this->dto->height;
    }
}