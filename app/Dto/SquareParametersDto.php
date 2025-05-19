<?php

declare(strict_types=1);

namespace App\Dto;

final readonly class SquareParametersDto implements ShapeParametersDtoInterface
{
    public function __construct(
        public float $height,
        public float $width,
    ) {
    }
}