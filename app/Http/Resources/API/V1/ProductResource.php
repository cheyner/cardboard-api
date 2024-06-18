<?php

declare(strict_types=1);

namespace App\Http\Resources\API\V1;

use App\Enums\Categories;
use App\Enums\Currencies;
use App\Enums\Denominations;
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
                'franchise' => $this->resource->franchise,
                'provider' => $this->resource->provider,
                'external_id' => $this->resource->external_id,
                'language' => $this->resource->language,
                'image_path' => $this->resource->image_path,
                'set_code' => $this->resource->release->code,
                'set_name' => $this->resource->release->name,
                'currency' => Currencies::USD->value,
                'denomination' => Denominations::CENTS->value,
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
