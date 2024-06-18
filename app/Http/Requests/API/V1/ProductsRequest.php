<?php

declare(strict_types=1);

namespace App\Http\Requests\API\V1;

use App\Enums\Providers;
use App\Models\Product;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

final class ProductsRequest extends FormRequest
{
    private ?array $providers = null;

    public function __construct()
    {
        $this->providers = collect(Providers::cases())->map(fn (Providers $provider) => $provider->value)->toArray();
    }

    public function authorize(): bool
    {
        return $this->user()->can('viewAny', Product::class);
    }

    public function rules(): array
    {
        return [
            'uuids' => 'nullable|string|max:1000',
            'provider' => [
                'nullable', 'string', Rule::in($this->providers),
            ],
            'external_ids' => 'nullable|string|max:2000',
        ];
    }

    public function messages(): array
    {
        return [
            'provider' => 'The provider must be in the following list: '.(implode(',', $this->providers)),
        ];
    }
}
