<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Http\Requests\ShapeRequest;
use App\Service\AreaService;
use Illuminate\Http\JsonResponse;

final readonly class ShapeController
{
    public function __construct(
        private AreaService $service,
    ) {
    }

    public function index(ShapeRequest $request): JsonResponse
    {
        return new JsonResponse(['area' => $this->service->calculate($request)]);
    }
}
