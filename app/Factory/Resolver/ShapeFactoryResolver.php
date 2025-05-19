<?php

declare(strict_types=1);

namespace App\Factory\Resolver;

use App\Enum\ShapeEnum;
use App\Factory\ShapeFactory;
use Illuminate\Support\Collection;
use RuntimeException;

final class ShapeFactoryResolver
{
    private Collection $factories;

    public function __construct() {
        $this->factories = collect();
    }

    public function add(ShapeEnum $shapeEnum, ShapeFactory $factory): void
    {
        $this->factories->put($shapeEnum->value, $factory);
    }

    public function resolve(ShapeEnum $shapeEnum): ShapeFactory
    {
        return $this->factories->get($shapeEnum->value)
            ?? throw new RuntimeException('Undefined factory');
    }
}