<?php

declare(strict_types=1);

use App\Http\Controllers\API\V1\Products;
use Illuminate\Support\Facades\Route;

Route::prefix('/products')->group(function () {

    Route::get('/', Products\IndexController::class)->name('index');

    Route::get('{uuid}', Products\ShowController::class)->name('show');

});
