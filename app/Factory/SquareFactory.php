<?php

declare(strict_types=1);

namespace App\Factory;

use App\Dto\SquareParametersDto;
use App\Models\Square;

final class SquareFactory extends ShapeFactory
{
    public function shape($parameters): Square
    {
        return new Square(new SquareParametersDto(...$parameters));
    }
}