<?php

declare(strict_types=1);

namespace App\Service;

use App\Factory\Resolver\ShapeFactoryResolver;
use App\Http\Requests\ShapeRequest;

final readonly class AreaService
{
    public function __construct(
        private ShapeFactoryResolver $factoryResolver,
    ) {
    }

    public function calculate(ShapeRequest $request): float
    {
        $factory = $this->factoryResolver->resolve($request->type());

        return $factory->create($request->parameters())->calculate();
    }
}
