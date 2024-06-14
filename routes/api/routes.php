<?php

use App\Http\Controllers\API\Auth;
use Illuminate\Support\Facades\Route;
use Symfony\Component\HttpFoundation\Response;

Route::get('/status', static fn () => Response::HTTP_OK);

Route::post('login', Auth\LoginController::class)->name('login');

Route::post('register', Auth\RegisterController::class)->name('register');

Route::middleware(['auth:sanctum'])->group(function (): void {

    Route::get('user', static fn () => request()->user());

    Route::prefix('v1')->as('v1:')->group(base_path(
        path: 'routes/api/v1/routes.php',
    ));
});
