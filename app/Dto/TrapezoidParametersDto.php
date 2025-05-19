<?php

declare(strict_types=1);

namespace App\Dto;

final readonly class TrapezoidParametersDto implements ShapeParametersDtoInterface
{
    public function __construct(
        public float $height,
        public float $top_base,
        public float $bottom_base,
    ) {
    }
}