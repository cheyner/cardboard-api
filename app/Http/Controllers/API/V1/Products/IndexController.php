<?php

declare(strict_types=1);

namespace App\Http\Controllers\API\V1\Products;

use App\Http\Requests\API\V1\ProductsRequest;
use App\Http\Resources\API\V1\ProductResource;
use App\Models\Product;
use Illuminate\Contracts\Support\Responsable;
use Illuminate\Database\Eloquent\Builder;

final class IndexController
{
    public function __invoke(ProductsRequest $request): Responsable
    {
        $collection = Product::with(
            relations: ['prices', 'release'],
        )->when(
            value: $request->get('uuids'),
            callback: fn (Builder $query) => $query->whereIn(
                column: 'uuid',
                values: explode(',', $request->get('uuids')),
            ),
        )
            ->when(
                value: $request->get('provider'),
                callback: function (Builder $query) use ($request) {
                    $query->where('provider', $request->get('provider'));
                }
            )
            ->simplePaginate(
                perPage: config('app.products_pagination_amount'),
            );

        return ProductResource::collection($collection);
    }
}
