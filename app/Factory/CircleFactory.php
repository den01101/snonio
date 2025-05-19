<?php

declare(strict_types=1);

namespace App\Factory;

use App\Dto\CircleParametersDto;
use App\Models\Circle;

final class CircleFactory extends ShapeFactory
{
    public function shape($parameters): Circle
    {
        return new Circle(new CircleParametersDto(...$parameters));
    }
}