<?php

declare(strict_types=1);

namespace App\Dto;

final readonly class CircleParametersDto implements ShapeParametersDtoInterface
{
    public function __construct(
        public float $radius,
    ) {
    }
}