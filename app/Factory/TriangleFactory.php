<?php

declare(strict_types=1);

namespace App\Factory;

use App\Dto\TriangleParametersDto;
use App\Models\Triangle;

final class TriangleFactory extends ShapeFactory
{
    public function shape($parameters): Triangle
    {
        return new Triangle(new TriangleParametersDto(...$parameters));
    }
}