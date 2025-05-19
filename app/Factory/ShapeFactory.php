<?php

declare(strict_types=1);

namespace App\Factory;

use App\Models\ShapeInterface;

abstract class ShapeFactory
{
    public function create(array $parameters): ShapeInterface
    {
        return $this->shape($parameters);
    }

    abstract public function shape($parameters): ShapeInterface;
}