<?php

declare(strict_types=1);

namespace App\Http\Resources\Api\V1;

use App\Enums\Categories;
use App\Enums\Finishes;
use App\Models\Product;
use App\Models\ProductPrice;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

/**
 * @property-read Product $resource
 */
final class ProductResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'uuid' => $this->resource->uuid,
            'type' => Categories::CARD->value,
            'attributes' => [
                'name' => $this->resource->name,
                'image_path' => $this->resource->image_path,
                'set_code' => $this->resource->release->code,
                'set_name' => $this->resource->release->name,
                'latest_prices' => [
                    'nonfoil' => $this->getLatestPrice(Finishes::NONFOIL),
                    'foil' => $this->getLatestPrice(Finishes::FOIL),
                    'etched' => $this->getLatestPrice(Finishes::ETCHED),
                ],
            ],
        ];
    }

    protected function getLatestPrice(Finishes $finish): ?array
    {
        $productPrice = ProductPrice::mostRecentForFinish($this->resource, $finish)->first();

        if ($productPrice) {
            return [
                'price' => $productPrice->price,
                'created_at' => $productPrice->created_at,
            ];
        }

        return null;
    }
}
