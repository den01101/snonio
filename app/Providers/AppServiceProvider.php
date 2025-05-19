<?php

namespace App\Providers;

use App\Enum\ShapeEnum;
use App\Factory\CircleFactory;
use App\Factory\ParallelogramFactory;
use App\Factory\Resolver\ShapeFactoryResolver;
use App\Factory\SquareFactory;
use App\Factory\TrapezoidFactory;
use App\Factory\TriangleFactory;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->singleton(ShapeFactoryResolver::class, function () {
            $shapeFactoryResolver = new ShapeFactoryResolver();

            $shapeFactoryResolver->add(ShapeEnum::SQUARE, new SquareFactory());
            $shapeFactoryResolver->add(ShapeEnum::CIRCLE, new CircleFactory());
            $shapeFactoryResolver->add(ShapeEnum::TRIANGLE, new TriangleFactory());
            $shapeFactoryResolver->add(ShapeEnum::TRAPEZOID, new TrapezoidFactory());
            $shapeFactoryResolver->add(ShapeEnum::PARALLELOGRAM, new ParallelogramFactory());

            return $shapeFactoryResolver;
        });
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
