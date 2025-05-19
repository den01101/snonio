<?php

declare(strict_types=1);

namespace App\Factory;

use App\Dto\ParallelogramParametersDto;
use App\Models\Parallelogram;

final class ParallelogramFactory extends ShapeFactory
{
    public function shape($parameters): Parallelogram
    {
        return new Parallelogram(new ParallelogramParametersDto(...$parameters));
    }
}