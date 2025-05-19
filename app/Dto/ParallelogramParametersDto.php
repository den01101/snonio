<?php

declare(strict_types=1);

namespace App\Dto;

final readonly class ParallelogramParametersDto implements ShapeParametersDtoInterface
{
    public function __construct(
        public float $height,
        public float $base,
    ) {
    }
}