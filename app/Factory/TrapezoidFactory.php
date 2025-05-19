<?php

declare(strict_types=1);

namespace App\Factory;

use App\Dto\TrapezoidParametersDto;
use App\Models\Trapezoid;

final class TrapezoidFactory extends ShapeFactory
{
    public function shape($parameters): Trapezoid
    {
        return new Trapezoid(new TrapezoidParametersDto(...$parameters));
    }
}