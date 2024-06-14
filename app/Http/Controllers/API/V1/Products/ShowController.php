<?php

declare(strict_types=1);

namespace App\Http\Controllers\API\V1\Products;

use App\Http\Requests\API\V1\ProductRequest;
use App\Http\Resources\API\V1\ProductResource;
use App\Models\Product;
use Illuminate\Database\Eloquent\ModelNotFoundException;

final class ShowController
{
    public function __invoke(ProductRequest $request, string $uuid)
    {
        try {
            $product = Product::query()->where(
                column: 'uuid',
                operator: '=',
                value: $uuid,
            )->firstOrFail();
        } catch (\Exception $e) {
            throw new ModelNotFoundException("Could not find product with uuid {$uuid}");
        }

        return new ProductResource($product);
    }
}
