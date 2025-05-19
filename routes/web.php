<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ShapeController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/shapes', function () {
    return view('shapes');
})->name('shapes');

Route::post('/shape/calculate', [ShapeController::class, 'index'])->name('shape.calculate');
