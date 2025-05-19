<?php

declare(strict_types=1);

namespace App\Enum;

enum ShapeEnum: string
{
    case SQUARE = 'square';
    case CIRCLE = 'circle';
    case TRIANGLE = 'triangle';
    case TRAPEZOID = 'trapezoid';
    case PARALLELOGRAM = 'parallelogram';

    public function parameters(): array
    {
        return match ($this) {
            self::SQUARE => [
                'width',
                'height'
            ],
            self::CIRCLE => [
                'radius',
            ],
            self::TRIANGLE,
            self::PARALLELOGRAM => [
                'base',
                'height',
            ],
            self::TRAPEZOID => [
                'top_base',
                'bottom_base',
                'height',
            ],
        };
    }
}
