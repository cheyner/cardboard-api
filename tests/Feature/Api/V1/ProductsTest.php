<?php

declare(strict_types=1);

use App\Http\Controllers\Api\V1\Products\IndexController;
use App\Models\User;
use Symfony\Component\HttpFoundation\Response;

use function Pest\Laravel\actingAs;

test('the products index returns the correct status code', function (): void {
    actingAs(User::factory()->create())->getJson(
        uri: action(IndexController::class),
    )->assertStatus(Response::HTTP_OK);
});
