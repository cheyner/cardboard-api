<?php

declare(strict_types=1);

namespace App\Http\Requests\API\V1;

use App\Enums\Providers;
use App\Models\Product;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

final class ProductsRequest extends FormRequest
{
    public function authorize(): bool
    {
        return $this->user()->can('viewAny', Product::class);
    }

    public function rules(): array
    {
        return [
            'uuids' => 'nullable|string|max:1000',
            'provider' => [
                'nullable', 'string', Rule::in(collect(Providers::cases())->map(fn (Providers $provider) => $provider->value)->toArray()),
            ],
        ];
    }
}
