<?php

declare(strict_types=1);

namespace App\Models;

use App\Dto\CircleParametersDto;

final readonly class Circle implements ShapeInterface
{
    public function __construct(
        private CircleParametersDto $dto,
    ) {
    }

    public function calculate(): float
    {
        return 3.15 * ($this->dto->radius ** 2);
    }
}