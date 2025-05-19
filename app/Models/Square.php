<?php

declare(strict_types=1);

namespace App\Models;

use App\Dto\SquareParametersDto;

final readonly class Square implements ShapeInterface
{
    public function __construct(
        private SquareParametersDto $dto,
    ) {
    }

    public function calculate(): float
    {
        return $this->dto->height * $this->dto->width;
    }
}