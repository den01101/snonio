<?php

declare(strict_types=1);

namespace App\Models;

interface ShapeInterface
{
    public function calculate(): float;
}