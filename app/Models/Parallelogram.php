<?php

declare(strict_types=1);

namespace App\Models;

use App\Dto\ParallelogramParametersDto;

final readonly class Parallelogram implements ShapeInterface
{
    public function __construct(
        private ParallelogramParametersDto $dto,
    ) {
    }

    public function calculate(): float
    {
        return $this->dto->base * $this->dto->height;
    }
}